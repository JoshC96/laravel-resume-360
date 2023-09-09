<?php

namespace App\Repositories;

use App\Models\AiResponse;

class AiResponseRepository
{

    /**
     * @param array $data 
     * @return AiResponse
     */
    public function createAiResponse(array $data): AiResponse
    {
        $response = new AiResponse();
        $response->fill($data);
        $response->save();

        return $response;
    }
}