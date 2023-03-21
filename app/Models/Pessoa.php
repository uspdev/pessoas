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

    public function replicado()
    {
        $dump = PessoaReplicado::dump($this->codpes);

        if ($dump['nompes'] != $dump['nompesttd']) {
            $nome = $dump['nompesttd'] . '(' . $dump['nompes'] . ')';
        } else {
            $nome = $dump['nompes'];
        }

        if ($dump['sexpes'] == 'M') {
            $genero = 'Masculino';
        } elseif ($dump['sexpes'] == 'F') {
            $genero = 'Feminino';
        } else {
            $genero = 'Não informado';
        }

        $documentos[] = "CPF: " . Generic::formatarCpf($dump['numcpf']);
        $documentos[] = "{$dump['tipdocidf']}: {$dump['numdocfmt']} {$dump['sglorgexdidf']}/{$dump['sglest']}";

        return [
            'nome' => $nome,
            'documentos' => $documentos,
            'nasc' => \Carbon\Carbon::parse($dump['dtanas'])->format('d/m/Y'),
            'genero' => $genero,
            'telefones' => PessoaReplicado::telefones($this->codpes),
            'emails' => PessoaReplicado::emails($this->codpes),
            'vinculosAtivos' => PessoaReplicado::listarVinculosAtivos($this->codpes),
            'vinculosEncerrados' => PessoaReplicado::listarVinculosEncerrados($this->codpes),
            'endereco' => PessoaReplicado::retornarEnderecoFormatado($this->codpes),
            'ramal' => PessoaReplicado::obterRamalUsp($this->codpes),
            'lattes' => ($lattes = Lattes::id($this->codpes))
            ? 'Lattes: <a href="https://lattes.cnpq.br/' . $lattes . '" target="_lattes">' . $lattes . '</a>'
            : 'Lattes: -',
            'orcid' => ($orcid = Lattes::retornarOrcidID($this->codpes))
            ? 'Orcid: <a href="' . $orcid . '" target="_orcid">' . str_replace('https://orcid.org/', '', $orcid) . '</a>'
            : 'Orcid: -',
        ];
    }

    /**
     * Formata o vinculo da pessoa para ser apresentado, tanto ativos quanto finalizados
     *
     * Para cada tipo de vinculo mostra os dados necessários
     *
     * @param Array $vinculo conforme consulta do Replicado::listarVinculosAtivos
     * @return String
     * @author Masaki K Neto, 4/2021
     */
    public function vinculoFormatado($vinculo)
    {
        $ret = '';
        if (!empty($vinculo['tipvin'])) {
            $ret = $ret . $vinculo['tipvin'];
        }

        if (!empty($vinculo['tipvinext']) && $vinculo['tipvinext'] != 'Servidor') {
            $ret .= ' <i class="fas fa-angle-right"></i> ' . $vinculo['tipvinext'];
        }

        switch ($vinculo['tipvin']) {
            case 'ALUNOPOS':
                if ($pg = Posgraduacao::obterVinculoAtivo($this->codpes)) {
                    $ret .= ' | programa: ' . $pg['nomcur'] . ', área: ' . $pg['nomare'] . ', nível: ' . $pg['nivpgm'] . ', orientador: <a href="pessoas/' . $pg['codpesori'] . '">' . $pg['nompesori'] . '</a>';
                }
                break;
            case 'ALUNOGR':
                if ($gr = Graduacao::obterCursoAtivo($this->codpes)) {
                    $ret .= ' | curso: ' . $gr['nomcur'] . ', hab: ' . $gr['nomhab']; // . ', área: ' . $pg['nomare'] . ', nível: ' . $pg['nivpgm'] . ', orientador: <a href="pessoas/' . $pg['codpesori'] . '">' . $pg['nompesori'] . '</a>' . ', ingresso: ' . date('d/m/Y', strtotime($vinculo['dtainivin']));
                }
                break;
            case 'SERVIDOR':
            default:
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
}
