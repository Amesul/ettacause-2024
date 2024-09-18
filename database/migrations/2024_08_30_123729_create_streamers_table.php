<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('streamers', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('display_name');
            $table->text('description');
            $table->string('profile_image_url');
            $table->string('slc_access_token')->nullable();
            $table->string('title')->nullable();
            $table->boolean('online')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('streamers');
    }
};
