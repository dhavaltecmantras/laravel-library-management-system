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
        Schema::table('issued_book_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('status')->after('penalty')->default(1);
            $table->foreign('status')->references('id')->on('book_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issued_book_logs', function (Blueprint $table) {
            $table->dropForeign('status');
            $table->dropColumn('status');
        });
    }
};
