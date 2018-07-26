<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('privacy_id');
            $table->unsignedInteger('pledge_id')->nullable();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('privacy_id')->references('id')->on('campaigns_posts_privacies')->onDelete('cascade');
            $table->foreign('pledge_id')->references('id')->on('campaigns_pledges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns_posts');
    }
}
