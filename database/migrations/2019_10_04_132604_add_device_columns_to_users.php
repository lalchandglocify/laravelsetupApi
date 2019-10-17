<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_type',80 )->after('login_time')
                                ->nullable()
                                ->default(null);
            $table->longText('device_info' )->after('device_type')
                                ->nullable()
                                ->default(null);
            $table->longText('device_token')->after('device_info')
                                ->nullable()
                                ->default(null);
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
            $table->dropColumn('device_type');
            $table->dropColumn('device_info');
            $table->dropColumn('device_token');
        });
    }
}
