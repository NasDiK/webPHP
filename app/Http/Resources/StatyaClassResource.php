<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatyaClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'lid' => $this->lid,
            'image' => $this->image,
            'content' => $this->content,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'rubric' => new RubricsClassResource($this->rubric)
        ];
    }
}