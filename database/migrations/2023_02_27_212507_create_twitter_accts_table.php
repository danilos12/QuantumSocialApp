<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterAcctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_accts', function (Blueprint $table) {
            $table->id();
            $table->string('twitter_id');
            $table->string('twitter_name', 100);
            $table->string('twitter_username', 100);
            $table->string('twitter_photo', 255);
            $table->text('twitter_description', 255);
            $table->string('twitter_followingCount', 100);
            $table->string('twitter_followersCount', 100);
            $table->string('twitter_tweetCount', 100);
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twitter_accts');
    }
}
