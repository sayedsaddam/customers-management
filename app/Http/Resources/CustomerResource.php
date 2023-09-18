<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'fatherName' => $this->fatherName,
            'cnic' => $this->cnic,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'city' => $this->city,
            'address' => $this->address,
            'nokName' => $this->nokName,
            'nokCnic' => $this->nokCnic,
            'nokPhone' => $this->nokPhone,
            'nokEmail' => $this->nokEmail,
            'nokRelation' => $this->nokRelation,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
