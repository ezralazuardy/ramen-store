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
        Schema::create("ramens", function (Blueprint $table) {
            $table->id();
            $table
                ->integer("category_id")
                ->nullable(false)
                ->default(1);
            $table
                ->integer("user_id")
                ->nullable(false)
                ->default(1);
            $table
                ->integer("store_id")
                ->nullable(false)
                ->default(1);
            $table->string("name")->nullable(false);
            $table
                ->integer("stock")
                ->nullable(false)
                ->default(0);
            $table
                ->integer("price")
                ->nullable(false)
                ->default(0);
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
        Schema::dropIfExists("ramens");
    }
};
