<?php

namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\Resource;

class Response extends Resource
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
            'status_code' => $this->status_code,
            'reason_phrase' => $this->reason_phrase,
            'findings' => collect($this->findings)->map(function ($finding) {
                return [
                    'name' => $finding['name'],
                    'description' => $finding['description'],
                    'risk_level' => $finding['risk_level'],
                    'validation_type' => $finding['validation_type'],
                    'validation_value' => $finding['validation_value'],
                ];
            }),
            'response_headers' => ResponseHeader::collection($this->whenLoaded('responseHeaders')),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
