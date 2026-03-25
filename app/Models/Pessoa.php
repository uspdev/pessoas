<?php

namespace App\Models;

use App\Replicado\Lattes;
use Uspdev\Utils\Generic;
use Uspdev\Replicado\Uteis;
use App\Replicado\Graduacao;
use Uspdev\Replicado\Posgraduacao;
use Illuminate\Database\Eloquent\Model;
use App\Replicado\Pessoa as PessoaReplicado;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pessoa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function dataNascimento(): Attribute
    {
        return Attribute::make(
            get: fn($value) => implode('/', array_reverse(explode('-', $value))),
            set: fn($value) => !empty($value)
                ? implode('-', array_reverse(explode('/', $value)))
                : null
        );
    }

    protected function validadeVisto(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value)
                ? implode('/', array_reverse(explode('-', $value)))
                : null,
            set: fn($value) => !empty($value)
                ? implode('-', array_reverse(explode('/', $value)))
                : null
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !empty($value)
                ? substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2)
                : null,
            set: fn($value) => !empty($value)
                ? preg_replace('/[^0-9]/', '', $value)
                : null
        );
    }

    protected function sexo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value === 'M' ? 'Masculino' : ($value === 'F' ? 'Feminino' : null),
        );
    }

    /**
     * Retorna dados replicados de acordo com $campo
     *
     * @param String $campo
     * @return Mixed
     */
    public function replicado(String $campo)
    {
        switch ($campo) {
            case 'nome':
                $dump = PessoaReplicado::dump($this->codpes);
                if ($dump['nompes'] != $dump['nompesttd']) {
                    $nome = $dump['nompesttd'] . '(' . $dump['nompes'] . ')';
                } else {
                    $nome = $dump['nompes'];
                }
                return $nome;
                break;
            case 'documentos':
                $dump = PessoaReplicado::dump($this->codpes);
                $documentos[] = "CPF: " . Generic::formatarCpf($dump['numcpf']);
                $documentos[] = "{$dump['tipdocidf']}: {$dump['numdocfmt']} {$dump['sglorgexdidf']}/{$dump['sglest']}";
                return $documentos;
                break;
            case 'nasc':
                $dump = PessoaReplicado::dump($this->codpes);
                return \Carbon\Carbon::parse($dump['dtanas'])->format('d/m/Y');
                break;
            case 'genero':
                $dump = PessoaReplicado::dump($this->codpes);
                if ($dump['sexpes'] == 'M') {
                    $genero = 'Masculino';
                } elseif ($dump['sexpes'] == 'F') {
                    $genero = 'Feminino';
                } else {
                    $genero = 'Não informado';
                }
                return $genero;
                break;
            case 'telefones':
                return PessoaReplicado::telefones($this->codpes);
                break;
            case 'emails':
                return PessoaReplicado::emails($this->codpes);
                break;
            case 'vinculosAtivos':
                $vinculos = [];
                foreach (PessoaReplicado::listarVinculosAtivos($this->codpes) as $v) {
                    $vinculos[] = $this->vinculoFormatado($v);
                }
                return $vinculos;
                break;
            case 'vinculosEncerrados':
                return PessoaReplicado::listarVinculosEncerrados($this->codpes);
                break;
            case 'endereco':
                return PessoaReplicado::retornarEnderecoFormatado($this->codpes);
                break;
            case 'ramal':
                return PessoaReplicado::obterRamalUsp($this->codpes);
                break;
            case 'lattes':
                return ($lattes = Lattes::id($this->codpes))
                    ? 'Lattes: <a href="https://lattes.cnpq.br/' . $lattes . '" target="_lattes">' . $lattes . '</a>'
                    : 'Lattes: -';
                break;
            case 'lattesAtualizacao':
                return Lattes::retornarDataUltimaAtualizacao($this->codpes);
                break;
            case 'orcid':
                return ($orcid = Lattes::retornarOrcidID($this->codpes))
                    ? 'Orcid: <a href="' . $orcid . '" target="_orcid">' . str_replace('https://orcid.org/', '', $orcid) . '</a>'
                    : 'Orcid: -';
                break;
        }
    }

    /**
     * Formata o vinculo da pessoa para ser apresentado, tanto ativos quanto finalizados
     *
     * Para cada tipo de vinculo mostra os dados necessários
     *
     * @param Array $vinculo conforme consulta do Replicado::listarVinculosAtivos
     * @return String
     * @author Masaki K Neto, 4/2021
     * @author Masaki K Neto, 1/2024, refatorado para vinculos inativos
     */
    public function vinculoFormatado($vinculo)
    {
        $ret = '';
        if (!empty($vinculo['tipvin'])) {
            $ret = $ret . $vinculo['tipvin'];
        }

        switch (trim($vinculo['tipvin'])) {
            case 'ALUNOPOS':
                if ($pg = Posgraduacao::obterVinculoAtivo($this->codpes)) {
                    $ret .= ' | programa: ' . $pg['nomcur'] . ', área: ' . $pg['nomare'] . ', nível: ' . $pg['nivpgm'] . ', orientador: <a href="pessoas/' . $pg['codpesori'] . '">' . $pg['nompesori'] . '</a>';
                } elseif (isset($vinculo['sglund'])) {
                    $ret .= ' | ' . $vinculo['sglund'];
                }
                break;
            case 'ALUNOGR':
                $gr = Graduacao::obterCursoAtivoUnidades($this->codpes);
                if (empty($gr)) {
                    $gr = Graduacao::obterCursoFinalizadoUnidades($this->codpes);
                }
                if ($gr) {
                    $ret .= ' | ' . $gr['sglund'] . ' | curso: ' . $gr['nomcur'] . ', hab: ' . $gr['nomhab']; // . ', área: ' . $pg['nomare'] . ', nível: ' . $pg['nivpgm'] . ', orientador: <a href="pessoas/' . $pg['codpesori'] . '">' . $pg['nompesori'] . '</a>' . ', ingresso: ' . date('d/m/Y', strtotime($vinculo['dtainivin']));
                }
                break;
            case 'SERVIDOR':
            default:
                if (!empty($vinculo['tipvinext']) && $vinculo['tipvinext'] != 'Servidor') {
                    $ret .= ' <i class="fas fa-angle-right"></i> ' . $vinculo['tipvinext'];
                }
                if (!empty($vinculo['sglund'])) {
                    $ret .= ' | ' . $vinculo['sglund'];
                }
                if (!empty($vinculo['nomcaa'])) {
                    $ret .= ' | ' . $vinculo['nomcaa'];
                }

                if (!empty($vinculo['nomfnc'])) {
                    $ret .= ' | ' . $vinculo['nomfnc'];
                }

                if (!empty($vinculo['nomabvset'])) {
                    $ret .= ' - (' . $vinculo['nomabvset'] . ') ' . $vinculo['nomset'];
                }

                if (!empty($vinculo['sglclgund'])) {
                    $ret = $ret . ' - ' . $vinculo['sglclgund'];
                }
        }

        if (empty($vinculo['dtafimvin'])) {
            $ret .= '<br /> Início: ' . Uteis::data_mes($vinculo['dtainivin']);
        } else {
            $ret .= '<br /> Período: ' . Uteis::data_mes($vinculo['dtainivin']) . ' a ' . Uteis::data_mes($vinculo['dtafimvin']);
        }

        return $ret;
    }

    /**
     * Retorna a categoria da pessoa (designados, afastados ou posgrad)
     */
    public function obterCategoria()
    {
        if (in_array($this->codpes, array_column(PessoaReplicado::listarDesignados(), 'codpes')))
            return 'designados';

        elseif (in_array($this->codpes, array_column(PessoaReplicado::listarAfastados(), 'codpes')))
            return 'afastados';

        elseif (Posgraduacao::verifica($this->codpes, env('REPLICADO_CODUNDCLG')))
            return 'posgrad';

        else
            return '';
    }

    /**
     * Verifica se possui algum campo extra preenchido
     * 
     * @return bool
     * @author Masaki K Neto, 7/2025
     */
    public function possuiDadosExtra(): bool
    {
        $excluded = ['id', 'codpes', 'created_at', 'updated_at'];

        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $excluded) && !empty($value)) {
                return true; // existe pelo menos um campo preenchido
            }
        }

        return false; // todos os campos (exceto os excluídos) são nulos ou vazios
    }
}
