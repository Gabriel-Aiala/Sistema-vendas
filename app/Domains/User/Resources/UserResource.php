<?php

namespace App\Domains\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'balance' => $this->balance,
            'type' => $this->type,
            'email' => $this->email,
            'created_at' => $this->created_at->format('d M Y H:i:s'),
        ];
    }
}
