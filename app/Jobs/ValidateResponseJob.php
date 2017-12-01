<?php

namespace App\Jobs;

use App\Profile;
use App\Response;
use Illuminate\Support\Collection;

class ValidateResponseJob extends Job
{
    /**
     * The Response that should be validated.
     *
     * @var Response
     */
    private $response;

    /**
     * The Profile that should be used to validate the Response.
     *
     * @var Profile
     */
    private $profile;

    /**
     * @param Response $response
     * @param Profile $profile
     */
    public function __construct(Response $response, Profile $profile)
    {
        $this->response = $response;
        $this->profile = $profile;
    }

    public function handle()
    {
        $responseHeaders = $this->response->responseHeaders->pluck('value', 'name');
        $validationRules = $this->getValidationRules();

        $findings = collect();

        $validator = $this->getValidator($responseHeaders->toArray(), $validationRules->toArray());
        if ($validator->fails()) {
            $headers = $this->profile->headerRules->groupBy('name');

            foreach ($validator->failed() as $headerName => $rules) {
                foreach (array_keys($rules) as $rule) {
                    $findings->push($headers->get($headerName)->where('validation_type', strtolower($rule))->first());
                }
            }
        }

        $this->response->findings = $findings;
        $this->response->save();
    }

    /**
     * Validation rules for the validator.
     *
     * @return Collection
     */
    private function getValidationRules(): Collection
    {
        $rules = collect();

        $headers = $this->profile->headerRules->groupBy('name');
        foreach ($headers as $headerName => $headerRules) {
            $rules->put($headerName, $headerRules->pluck('validation_rule'));
        }

        return $rules;
    }
}
