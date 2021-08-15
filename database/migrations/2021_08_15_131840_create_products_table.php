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
            $table->bigIncrements('id')->comment('スレッドID');
            $table->unsignedBigInteger('member_id')->comment('会員ID');
            $table->unsignedBigInteger('product_category_id')->comment('カテゴリID');
            $table->unsignedBigInteger('product_subcategory_id')->comment('サブカテゴリID');
            $table->string('name')->comment('商品名');
            $table->string('image_1')->comment('写真１')->nullable();
            $table->string('image_2')->comment('写真２')->nullable();
            $table->string('image_3')->comment('写真３')->nullable();
            $table->string('image_4')->comment('写真４')->nullable();
            $table->text('product_content')->comment('商品説明');
            $table->timestamps();
            $table->softDeletes()->comment('削除日時');

            $table->foreign('member_id')->references('id')->on('members');
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
