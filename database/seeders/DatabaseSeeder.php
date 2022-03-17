<?php

namespace Database\Seeders;

use App\Models\Guestbook;
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
        $this->call(UsersTableSeeder::class);
        Guestbook::factory(10)->withGuestRole()->create();
    }
}
