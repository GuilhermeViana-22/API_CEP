<?php

namespace App\Http\Controllers;
use App\Http\Resources\CepResource;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    /***
     * Método utilizado para realizar a busca por ceps
     * Obtem o retorno em formato json
     * coleção de dados conforme parametros enviados
     * @param string $ceps
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(string $ceps)
    {
        $cepsArray = explode(',', $ceps);
        $results = [];

        foreach ($cepsArray as $cep) {
            $response = Http::withOptions(['verify' => false])->get("https://viacep.com.br/ws/{$cep}/json/");

            //se a api via cep responder com sucesso
            if ($response->successful()) {
                $results[] = $response->json();
            }
        }

        // Transformar os dados em instâncias de CepResource
        $cepResources = collect($results)->map(function ($item) {
            return new CepResource((object) $item);
        });

        //retorna a collection em formato json
        return response()->json(CepResource::collection($cepResources));
    }

}
