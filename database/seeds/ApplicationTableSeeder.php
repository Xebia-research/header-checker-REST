<?php

use App\Application;
use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->truncate();

        $application = new Application;
        $application->name = 'Demo';
        $application->api_key = 'demo';
        $application->save();
    }
}
