<?php

namespace App\Models;

use App\Replicado\Graduacao;
use App\Replicado\Lattes;
use App\Replicado\Pessoa as PessoaReplicado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Uspdev\Replicado\Posgraduacao;
use Uspdev\Replicado\Uteis;
use Uspdev\Utils\Generic;

class Pessoa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getDataNascimentoAttribute($value)
    {
        return implode('/', array_reverse(explode('-', $value)));
    }

    public function setDataNascimentoAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['data_nascimento'] = implode('-', array_reverse(explode('/', $value)));
        }
    }

    public function getValidadeVistoAttribute($value)
    {
        if (!empty($value)) {
            return implode('/', array_reverse(explode('-', $value)));
        }
    }

    public function setValidadeVistoAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['validade_visto'] = implode('-', array_reverse(explode('/', $value)));
        }
    }

    public function getCpfAttribute($value)
    {
        if (!empty($value)) {
            return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
        }
    }

    public function setCpfAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['cpf'] = preg_replace('/[^0-9]/', '', $value);
        }
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
            case 'endereco':return PessoaReplicado::retornarEnderecoFormatado($this->codpes);
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

        switch ($vinculo['tipvin']) {
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
}
