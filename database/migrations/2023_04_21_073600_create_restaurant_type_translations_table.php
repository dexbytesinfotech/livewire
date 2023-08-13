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
        Schema::create('store_type_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_type_id');
            $table->string('locale')->index();
            $table->string('name', 100)->nullable();
            $table->foreign('store_type_id')->references('id')->on('store_types')->onDelete('cascade');
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
        Schema::dropIfExists('store_type_translations');
    }
};
