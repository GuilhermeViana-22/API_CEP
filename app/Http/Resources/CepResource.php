<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CepResource extends JsonResource
{
    /**
     * Método para realizar a organização da coleção de dados
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'cep' => $this->cep,
            'label' => "{$this->logradouro}, {$this->localidade}",
            'logradouro' => $this->logradouro,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'localidade' => $this->localidade,
            'uf' => $this->uf,
            'ibge' => $this->ibge,
            'gia' => $this->gia,
            'ddd' => $this->ddd,
            'siafi' => $this->siafi,
        ];
    }
}
