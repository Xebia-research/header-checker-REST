<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\Resource;

class Request extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'error_message' => $this->error_message,
            'endpoint' => Endpoint::make($this->whenLoaded('endpoint')),
            'profile' => Profile::make($this->whenLoaded('profile')),
            'request_headers' => RequestHeader::collection($this->whenLoaded('requestHeaders')),
            'responses' => Response::collection($this->whenLoaded('responses')),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
