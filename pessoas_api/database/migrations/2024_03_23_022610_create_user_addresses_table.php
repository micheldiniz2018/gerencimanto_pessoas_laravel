<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street',150);
            $table->string('district',150);
            $table->string('postal_code',20);
            $table->bigInteger('number');
            $table->unsignedBigInteger('user_city_id');
            $table->unsignedBigInteger('user_state_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('user_city_id')
                ->references('id')
                ->on('user_cities')
                ->onDelete('cascade');

            $table->foreign('user_state_id')
                ->references('id')
                ->on('user_states')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
