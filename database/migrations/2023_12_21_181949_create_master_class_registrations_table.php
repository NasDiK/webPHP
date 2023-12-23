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
        Schema::create('master_class_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('masterClassId');
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('masterClassId')->references('id')->on('master_classes');
            $table->unique(['userId','masterClassId'], 'userId_masterClassId_unique');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_class_registrations');
    }
};
