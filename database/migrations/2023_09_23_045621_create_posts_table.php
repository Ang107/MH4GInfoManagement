<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
            $table->integer('default_level');
            $table->foreignId('right_monster_id')->constrained('monsters'); 
            $table->integer('right_monster_area');
            $table->foreignId('left_monster_id')->constrained('monsters'); 
            $table->integer('left_monster_area');
            $table->foreignId('area_1_id')->constrained('areas'); 
            $table->foreignId('area_2_id')->constrained('areas'); 
            $table->foreignId('area_3_id')->constrained('areas'); 
            $table->foreignId('area_4_id')->constrained('areas'); 
            $table->integer('treasure_area_number');
            $table->foreignId('weapon_id')->constrained(); 
            $table->foreignId('armor_id')->constrained(); 
            $table->foreignId('armor_port_id')->constrained(); 
            $table->string('generator');
            $table->integer('bookmark_number');
            $table->string('remark');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
