<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique()->nullable();
            $table->json('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('branch_section_id'); // divisions
            $table->unsignedBigInteger('company_manufacture_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->boolean('has_parent');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->boolean('expire_date');
            $table->integer('limit_demand')->nullable();
            $table->double('sale_price1');
            $table->double('sale_price2')->nullable();
            $table->double('sale_price3')->nullable();
            $table->double('purchase_price1')->nullable();
            $table->double('purchase_price2')->nullable();
            $table->double('purchase_price3')->nullable();
            $table->double('multiply_factor')->nullable();
            $table->integer('number_of_small_unit')->nullable();
            $table->integer('contain_child_from_parent')->nullable();
            $table->double('total_quantity')->default(0); // الرصيد الحالي
            $table->dateTime('balance_last_date')->nullable();
            $table->integer('start_amount')->nullable();
            $table->boolean('favorite');
            $table->boolean('related_store');
            $table->boolean('related_tax');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
