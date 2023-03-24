<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('type')->default(1);
            $table->integer('created_by');
            $table->timestamp('last_login_at')->nullable();
            $table->string('token_reset')->nullable();
            $table->date('brith_day')->nullable();
            $table->integer('gender')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('address')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
