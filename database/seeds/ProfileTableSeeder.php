<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_header_rule')->truncate();
        DB::table('profiles')->truncate();

        $profile = new Profile;
        $profile->name = 'Static Site';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'API';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'Web App';
        $profile->save();
    }
}
