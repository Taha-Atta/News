<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $data =  [
            'name'=>$this->name,
            'status'=>$this->status(),
            'Created_date'=>$this->created_at->diffForHumans(),
        ];

        if($request->is('api/account/user')){
            $data['id']=$this->id;
            $data['email']=$this->email;
            $data['country']=$this->country;
            $data['city']=$this->city;
            $data['street']=$this->street;
            $data['username']=$this->username;
            $data['image']=asset($this->image);
            $data['phone']=$this->phone;
            $data['status']=$this->status;
        }
        return $data;
    }
}
