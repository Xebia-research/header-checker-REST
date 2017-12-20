<?php

namespace App\Http\Resources\Xml;

use App\Http\Resources\Types\Xml\Resource;

class Response extends Resource
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
    public static $wrap = 'response';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $findings = collect($this->findings);

        return [
            'status_code' => $this->status_code,
            'reason_phrase' => $this->reason_phrase,

            $this->mergeWhen($findings->isNotEmpty(), [
                'findings' => [
                    'finding' => $findings->map(function ($finding) {
                        return [
                            'name' => $finding['name'],

                            $this->mergeWhen(! empty($finding['description']), [
                                'description' => $finding['description'],
                            ]),

                            'risk_level' => $finding['risk_level'],
                            'validation_type' => $finding['validation_type'],

                            $this->mergeWhen(! empty($finding['validation_value']), [
                                'validation_value' => $finding['validation_value'],
                            ]),
                        ];
                    })->toArray(),
                ],
            ]),

            $this->mergeWhen($this->whenLoaded('responseHeaders')->isNotEmpty(), [
                'response_headers' => [
                    ResponseHeader::$wrap => ResponseHeader::collection($this->whenLoaded('responseHeaders'))->toArray($request),
                ],
            ]),

            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
