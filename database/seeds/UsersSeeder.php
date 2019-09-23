<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nicolas',
            'lastName' => 'Gonzalez',
            'email' => 'admin@hofo.com',
            'phone' => '3005254584',
            'address' => 'calle falsa 123',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'type_chef' => 1,
            'have_restaurant_or_foodPoint' => 1,
            'FMCToken' => 'cStNigYrMnU:APA91bHu_-RWzgunprLbSXmm4T9TLr4kkX23RvYnDu3OBc74JlbqtZfN4ZU2QFNcKn18gHe23XqNTJpIlJzuHW14-tTBAa9TMxUePsuXt38EC_t9R23n7tPEQLMZ_Uvy8IIQIwHMN2aH'
        ]);
    }
}
