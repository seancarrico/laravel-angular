<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    protected $truncate = [
        'users'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->truncate as $table) {
            DB::table($table)->delete();
        }

        $this->call(UserTableSeeder::class);
        $this->call(TaskTableSeeder::class);
    }
}
