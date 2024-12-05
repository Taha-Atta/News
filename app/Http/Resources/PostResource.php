<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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
        $data = [
            'id'                               =>$this->id,
            'title'                               =>$this->title,
            'slug'                                =>$this->slug,
            'num_of_views'                        =>$this->num_of_views,
            'status'                              =>$this->status(),
            'date'                                =>$this->created_at->format('y-m-d h:m a'),
            'publisher'                           =>$this->user_id == null ?  AdminResource::make($this->Admin) : UserResource::make($this->user),
            'media'                               =>ImageResource::collection($this->images),
        ];

        if($request->is('api/posts/show/*') ){
            $data['category']                     = CategoryResource::make($this->category);
            $data['comment_able']                 = $this->comment_able == 1? 'active' : 'inactive';

        }

        return $data;
    }
}
