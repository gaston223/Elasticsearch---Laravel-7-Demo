<?php

use App\Models\Artist;
use App\Models\Punchline;
use App\Models\PunchlineProfile;
use App\Models\Title;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(User::class, 20)->create();
       factory(Title::class, 20)->create();
       factory(Artist::class, 20)->create();
       factory(Punchline::class, 20)->create();
       factory(PunchlineProfile::class, 40)->create();
    }
}
