<?php

namespace Ogilo\AdminMd\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "details" => $this->details,
            "avatar" => $this->avatar,
        ];
        // return parent::toArray($request);
    }
}
