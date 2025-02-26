<?php

namespace App\Services;

use App\Models\Tag;
use App\Traits\ResponseTrait;

class TagService {

    use ResponseTrait;

    public function SendErrorRessponseIfResourceNull(?Tag $tag)
    {
        if(!$tag) 
        {
            $reponse = $this->sendErrorResponse(
                error: 'Not found',
                code: 404
            );
            abort($reponse);
        }
    }
}