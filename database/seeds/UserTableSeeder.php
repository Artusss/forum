<?php
use Illuminate\Database\Seeder;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name' => 'admin1',
            'email' => 'admin1@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'admin',
        ]);
        App\User::create([
            'name' => 'admin2',
            'email' => 'admin2@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'admin',
        ]);
        App\User::create([
            'name' => 'author1',
            'email' => 'author1@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'author',
        ]);
        App\User::create([
            'name' => 'author2',
            'email' => 'author2@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'author',
        ]);
        App\User::create([
            'name' => 'guest1',
            'email' => 'guest1@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'guest',
        ]);
        App\User::create([
            'name' => 'guest2',
            'email' => 'guest2@root.root',
            'password' => bcrypt('secret170708'),
            'role' => 'guest',
        ]);
    }
}
