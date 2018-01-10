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
        $profile->name = 'Firefox';
        $profile->user_agent = 'Mozilla/5.0 (X11; Linuxi686; rv:7.0) Gecko/20101231 Firefox/3.6';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'Chrome';
        $profile->user_agent = 'Mozilla/5.0 (Macintosh; PPC Mac OS X 10_6_5) AppleWebKit/5312 (KHTML, like Gecko) Chrome/14.0.894.0 Safari/5312';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'Internet Explorer';
        $profile->user_agent = 'Mozilla/5.0 (compatible; MSIE 7.0; Windows 98; Win 9x 4.90; Trident/3.0)';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'Api';
        $profile->save();

        $profile = new Profile;
        $profile->name = 'Website';
        $profile->save();
    }
}
