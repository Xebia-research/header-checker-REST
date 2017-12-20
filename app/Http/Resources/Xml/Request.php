<?php

namespace App\Http\Resources\Xml;

use App\Http\Resources\Types\Xml\Resource;

class Request extends Resource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * PHP arrays can't have same-named keys, but XML can.
     * This wrapper renames your single resource nicely.
     *
     * <data>
     *   <resource>
     *     <id>123</id>
     *   </resource>
     * </data>
     *
     * @var string
     */
    public static $wrap = 'request';

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

            $this->mergeWhen(!empty($this->error_message), [
                'error_message' => $this->error_message,
            ]),

            'endpoint' => Endpoint::make($this->whenLoaded('endpoint'))->toArray($request),
            'profile' => Profile::make($this->whenLoaded('profile'))->toArray($request),

            $this->mergeWhen($this->whenLoaded('requestHeaders')->isNotEmpty(), [
                'request_headers' => [
                    RequestHeader::$wrap => RequestHeader::collection($this->whenLoaded('requestHeaders'))->toArray($request),
                ],
            ]),

            $this->mergeWhen($this->whenLoaded('responses')->isNotEmpty(), [
                'responses' => [
                    Response::$wrap => Response::collection($this->whenLoaded('responses'))->toArray($request),
                ],
            ]),

            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
