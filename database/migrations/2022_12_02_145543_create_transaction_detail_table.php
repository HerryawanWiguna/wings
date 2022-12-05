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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->string('doc_code', 3);
            $table->string('doc_number', 10);
            $table->string('product_code', 18);
            $table->float('price', 6, 0);
            $table->integer('quantity')->unsigned();
            $table->string('unit', 5);
            $table->float('sub_total', 10, 0);
            $table->string('currency', 5);
            $table->timestamps();

            $table->primary('doc_number');
            $table->foreign('product_code')->references('code')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_detail');
    }
};
