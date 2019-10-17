<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 80)->after('id')
                                ->nullable()
                                ->default(null);
            $table->string('last_name', 80)->after('first_name')
            ->nullable()
            ->default(null);

            $table->string('phone_number', 200)->after('email')
            ->nullable()
            ->default(null);
            $table->string('profile_picture', 200)->after('phone_number')
            ->nullable()
            ->default(null);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('first_name');
           $table->dropColumn('last_name');
           $table->dropColumn('phone_number');
           $table->dropColumn('profile_picture');
        });
    }
}
