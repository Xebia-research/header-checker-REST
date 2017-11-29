<?php

use App\HeaderRule;
use App\Profile;
use Illuminate\Database\Seeder;

class HeaderRuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_rules')->truncate();

        $headerRules = collect();

        $headerRule = new HeaderRule;
        $headerRule->name = 'Strict-Transport-Security';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Strict-Transport-Security';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^max-age=[0-9]+(; includeSubDomains)?(; preload)?$/';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Public-Key-Pins';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'Public-Key-Pins';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^pin-sha256="[a-zA-Z0-9=+]{44}"(; pin-sha256="[a-zA-Z0-9=+]{44}")*(; report-uri="((?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+)")(; max-age=[0-9]+)(; includeSubDomains)$/';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Frame-Options';
        $headerRule->validation_type = 'required';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $headerRule = new HeaderRule;
        $headerRule->name = 'X-Frame-Options';
        $headerRule->validation_type = 'regex';
        $headerRule->validation_value = '/^DENY|SAMEORIGIN|ALLOW-FROM: ((?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:\/?#[\]@!\$&\'\(\)\*\+,;=.]+)$/';
        $headerRule->risk_level = 'low'; // Todo
        $headerRule->save();

        $headerRules->push($headerRule);

        $profiles = Profile::all();
        foreach ($profiles as $profile) {
            $profile->headerRules()->attach($headerRules->pluck('id'));
        }
    }
}
