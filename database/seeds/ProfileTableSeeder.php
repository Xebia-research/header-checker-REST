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
        Profile::truncate();

        factory(Profile::class)->states('no_user_agent')->create([
            'name' => 'API',
        ]);
        factory(Profile::class)->states('no_user_agent')->create([
            'name' => 'Static Website',
        ]);

        factory(Profile::class)->states('no_user_agent')->create([
            'name' => 'Plain Connection (HTTP)',
            'identifier' => 'plain_connection',
        ]);
        factory(Profile::class)->states('no_user_agent')->create([
            'name' => 'Secure Connection (HTTPS)',
            'identifier' => 'secure_connection',
        ]);

        factory(Profile::class)->states('chrome')->create();
        factory(Profile::class)->states('firefox')->create();
        factory(Profile::class)->states('safari')->create();
        // factory(Profile::class)->states('opera')->create();
        factory(Profile::class)->states('internet_explorer')->create();
    }
}
