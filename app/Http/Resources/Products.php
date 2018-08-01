<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
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
          'id' => $this->id,
          'title' => $this->title,
          'description' => $this->description,
          'thumbnail_path' => !empty($this->thumbnails['key']) ?
              asset("images/" . $this->thumbnails['key'] . ".jpg") : ""
        ];
    }
}
