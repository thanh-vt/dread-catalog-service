<?php

use App\Models\Category;
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
            $table->string('code', 20)
                ->nullable(false)
                ->comment('Product code');
            $table->string('name', 200)
                ->nullable(false)
                ->comment('Product name');
            $table->string('description', 5000)
                ->nullable(false)
                ->comment('Product description');
            $table->string('origin_code', 5000)
                ->nullable(false)
                ->comment('Product origin');
            $table->smallInteger('status', false, true);
            $table->foreignIdFor(Category::class, 'category_id')
                ->index('category_product_idx')
                ->constrained('categories')
                ->nullOnDelete();
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
        Schema::dropIfExists('products');
    }
}
