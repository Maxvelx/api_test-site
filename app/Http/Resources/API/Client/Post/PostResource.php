<?php

namespace App\Http\Resources\API\Client\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => url(\Storage::url($this->path_image)),
            'time_read'   => $this->time_read,
            'time'        => $this->created_at ? $this->created_at->locale('en')->isoFormat('DD MMMM YYYY') : '',
            'category'    => $this->categories->title,
        ];
    }
}
