<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->truncate();

        $users = User::all();

        foreach (range(1, 30) as $value) {
            factory(App\Message::class, 1)->create(['user_id' => $users->random()->id]);
        }
    }
}
