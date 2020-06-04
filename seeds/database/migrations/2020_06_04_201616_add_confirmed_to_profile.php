<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmedToProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {

            $table->bigInteger('users_id')->unsigned()->unique();
            $table->boolean('confirmed')->default(false);
            $table->date('confirmed_at')->nullable();
            $table->decimal('amount', 5, 2)->comment('баланс');
            $table->double('bonus', 15, 8);

            $table->index(['confirmed', 'users_id'], 'ix_profile_confirmed_users_id');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropIndex('ix_profile_confirmed_users_id');

            $table->dropColumn('users_id');
            $table->dropColumn('confirmed');
            $table->dropColumn('confirmed_at');
            $table->dropColumn('amount');
            $table->dropColumn('bonus');
        });
    }
}
