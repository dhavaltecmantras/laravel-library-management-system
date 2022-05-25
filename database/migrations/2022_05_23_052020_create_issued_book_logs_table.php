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
        Schema::create('issued_book_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('book_name');
            $table->unsignedBigInteger('issuer_id');
            $table->string('issuer_name');
            $table->string('user_name');
            $table->string('user_address');
            $table->string('user_phone_number');
            $table->string('user_email');
            $table->string('penalty')->default("0");
            $table->text('notes')->nullable();
            $table->string('issued_quantity');
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('issuer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issued_book_logs');
    }
};
