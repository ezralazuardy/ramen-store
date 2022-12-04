<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ramen_stores", function (Blueprint $table) {
            $table->id();
            $table
                ->integer("user_id")
                ->nullable(false)
                ->default(1);
            $table->string("name")->nullable(false);
            $table->string("address")->nullable(false);
            $table->softDeletes();
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
        Schema::dropIfExists("ramen_stores");
    }
};
