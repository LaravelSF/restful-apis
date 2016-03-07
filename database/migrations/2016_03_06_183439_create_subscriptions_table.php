<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('account_id')->unsigned()->index();
            //$table->foreign('account_id')->references('id')->on('accounts')->onDeleted('cascade');
            $table->integer('subscriber_user_id')->unsigned()->index();
            //$table->foreign('subscriber_user_id')->references('id')->on('users');
            $table->integer('channel_id')->unsigned()->index();
            //$table->foreign('channel_id')->references('id')->on('channels')->onDeleted('cascade');
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
        Schema::table('subscriptions', function ($table) {
            //$table->dropForeign(['account_id']);
            //$table->dropForeign(['subscriber_user_id']);
            //$table->dropForeign(['channel_id']);
        });
        Schema::drop('subscriptions');
    }
}
