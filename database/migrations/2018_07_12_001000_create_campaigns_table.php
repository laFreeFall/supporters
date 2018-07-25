<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('activity');
            $table->text('description')->nullable();
            $table->boolean('holder');
            $table->unsignedInteger('color_id');
            $table->string('avatar')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('earnings')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('campaigns_categories')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('campaigns_colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
