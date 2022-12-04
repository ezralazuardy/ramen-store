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
        Schema::create("ramen_images", function (Blueprint $table) {
            $table->id();
            $table
                ->integer("ramen_id")
                ->nullable(false)
                ->default(1);
            $table
                ->integer("user_id")
                ->nullable(false)
                ->default(1);
            $table->text("image")->nullable(false);
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
        Schema::dropIfExists("ramen_images");
    }
};
