<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->category,
            "image" => get_attachment_url_only($this->image),
            "sub_categories" => $this->sub_categories->map(function($sub_category){
                return [
                    "id" => $sub_category->id,
                    "name" => $sub_category->sub_category,
                    "image" => get_attachment_url_only($sub_category->image),
                ];
            })
        ];
    }
}
