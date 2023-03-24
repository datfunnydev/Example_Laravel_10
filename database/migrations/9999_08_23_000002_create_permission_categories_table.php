<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_categories');
    }
};
