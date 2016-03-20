<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->text('description');
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        DB::statement("ALTER TABLE `tasks` ADD id CHAR(32) PRIMARY KEY NOT NULL FIRST;");
        DB::statement("ALTER TABLE `tasks` ADD user_id CHAR(32) NOT NULL AFTER id;");
        DB::statement("ALTER TABLE `tasks` ADD CONSTRAINT tasks_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
