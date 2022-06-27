<?php

namespace Ogilo\AdminMd\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "caption" => $this->caption,
            "icon" => $this->icon,
            "url" => $this->url,
            "menu_id" => $this->menu_id,
            "in_menu" => $this->in_menu,
        ];
        // return parent::toArray($request);
    }
}
