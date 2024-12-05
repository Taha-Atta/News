<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'read'=>$this->read_at,
            'notifiable_id'=>$this->notifiable_id,
            'user_name'=>$this->data['user_name'],
            'post_title'=>$this->data['post_title'],
            'comment'=>$this->data['comment'],
            'link'=>$this->data['link'],

        ];
    }
}
