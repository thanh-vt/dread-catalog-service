<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 20, 3)
                ->nullable(false)
                ->comment('Price value');
            $table->string('unit', 3)
                ->nullable(false)
                ->comment('Price unit');
            $table->dateTime('effect_date')
                ->nullable(false)
                ->comment('Price effect date');
            $table->foreignIdFor(Product::class, 'product_id')
                ->index('product_price_idx')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->unique(array('product_id', 'effect_date'), 'product_price_date_idx');
            $table->smallInteger('status', false, true);
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
        Schema::dropIfExists('product_prices');
    }
}
