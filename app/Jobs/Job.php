<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Validation\Validator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class Job implements ShouldQueue
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "queueOn" and "delay" queue helper methods.
    |
    */

    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get validator.
     *
     * @param array $input
     * @param array $rules
     * @return validator
     */
    protected function getValidator(array $input, array $rules)
    {
        return app('validator')
            ->make($input, $rules);
    }
}
