<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                    'name' => 'Администратор',
                    'email' => 'admin@admin.ru',
                    'password' => bcrypt('admin123'),
                    'role' => User::ROLE_ADMIN,
                ],
                [
                    'name' => 'Гость1',
                    'email' => 'guest1@example.ru',
                    'password' => bcrypt('guest123'),
                    'role' => User::ROLE_GUEST,
                ],
                [
                    'name' => 'Гость2',
                    'email' => 'guest2@example.ru',
                    'password' => bcrypt('guest1234'),
                    'role' => User::ROLE_GUEST,
                ],
            ]
        );
    }
}
