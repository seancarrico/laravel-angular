<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        while ($i <= 200) {
            $user = \App\User::orderByRaw('RAND()')->first();
            $task = factory('App\Task')->make();
            $task->user_id = $user->id;
            $task->save();
            $i++;
        }
    }
}
