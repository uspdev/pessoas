<?php

namespace App\Replicado;

use GuzzleHttp\Client;
use Uspdev\Replicado\DB;
use Uspdev\Replicado\Lattes as LattesReplicado;
use Uspdev\Replicado\Uteis;

class Lattes extends LattesReplicado
{
    /**
     * Retorna a foto do currículo lattes
     * 
     * Este método consulta a url do curriculo lattes que redireciona para 
     * outra url que usa um id que começa com k....
     * Com esse outro id é possível acessar a url de foto.
     *
     * @param Int $id Id lattes da pessoa
     * @return Img Blob da imagem
     * @author Masakik, em 3/4/2023
     */
    public static function obterFoto($id, $saveLocation = null)
    {
        $curriculoUrl = 'http://buscatextual.cnpq.br/buscatextual/cv?id=';
        $fotoUrl = 'http://servicosweb.cnpq.br/wspessoa/servletrecuperafoto?tipo=1&id=';

        $client = new Client();
        $response = $client->request('GET', $curriculoUrl . $id, ['allow_redirects' => false]);
        $headers = $response->getHeader('Location');

        parse_str($headers[0], $parsedUrl);

        $idk = $parsedUrl['id'] ?? null;

        $foto = file_get_contents($fotoUrl . $idk);
        if ($saveLocation) {
            file_put_contents($saveLocation, $foto);
        }
        return $foto;
    }
}
