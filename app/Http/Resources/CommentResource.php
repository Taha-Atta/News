<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment'=>$this->comment,
            'user-name'=>$this->user->name,
            'user-image'=>asset($this->user->image),
            'created_date'=>$this->created_at->diffForHumans(),
        ];
    }
}
