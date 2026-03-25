<?php

namespace App\Replicado;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Uspdev\Replicado\Lattes as LattesReplicado;
use Carbon\Carbon;

class Lattes extends LattesReplicado
{
    /**
     * Retorna a foto do currículo lattes
     * 
     * Este método consulta a url do curriculo lattes que redireciona para 
     * outra url que usa um id que começa com k....
     * Com esse outro id é possível acessar a url de foto.
     *
     * @param int $id Id lattes da pessoa
     * @return string Blob da imagem
     * @author Masakik, em 3/4/2023
     * @author Masakik, refactor em 25/3/2026
     */
    public static function obterFoto($id)
    {
        $path = "fotos/cnpq/{$id}.jpg";

        // Verifica cache de 24h
        if (Storage::exists($path)) {
            $lastModified = Storage::lastModified($path);
            if (Carbon::createFromTimestamp($lastModified)->isAfter(now()->subDay())) {
                return Storage::get($path);
            }
        }

        $idk = self::obterIdk($id);
        if (!$idk) return null;

        try {
            // Usando o Http Facade do Laravel (mais legível)
            $response = Http::timeout(5)->get("http://servicosweb.cnpq.br/wspessoa/servletrecuperafoto", [
                'tipo' => 1,
                'id' => $idk
            ]);

            if ($response->successful()) {
                $content = $response->body();
                $contentType = $response->header('Content-Type');

                if (str_contains($contentType, 'image') && strlen($content) > 500) {
                    Storage::put($path, $content);
                    return $content;
                }
            }
        } catch (\Exception $e) {
            Log::error("Erro ao buscar foto CNPq para ID {$id}: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Obtém o idk a partir do id lattes
     * 
     * @param Int $id Id lattes da pessoa
     * @return String|null Idk ou null se não encontrado
     */
    public static function obterIdk($id)
    {
        try {
            // allow_redirects => false é crucial aqui para pegar o Header Location
            $response = Http::timeout(5)->withOptions(['allow_redirects' => false])
                ->get("https://buscatextual.cnpq.br/buscatextual/cv?id={$id}");

            $location = $response->header('Location');
            if (empty($location)) return null;

            parse_str(parse_url($location, PHP_URL_QUERY), $query);
            return $query['id'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
