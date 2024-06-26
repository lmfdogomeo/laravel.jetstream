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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid")->unique();
            $table->string("product_name");
            $table->string("product_description");
            $table->double("price", [10, 2]);
            $table->integer("quantity");
            $table->bigInteger("merchant_id")->index()->unsigned();
            $table->foreign("merchant_id")->references("id")->on("merchants")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
