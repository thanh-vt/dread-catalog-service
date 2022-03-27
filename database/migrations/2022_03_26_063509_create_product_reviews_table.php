<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->text('content')
                ->nullable(false)
                ->comment('Review content');
            $table->smallInteger('rating', false, false)
                ->comment('Review rating');
            $table->foreignIdFor(Product::class, 'product_id')
                ->index('product_review_idx')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'buyer_id')
                ->index('buyer_review_idx')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unique(array('product_id', 'buyer_id'), 'product_buyer_review_idx');
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
        Schema::dropIfExists('product_reviews');
    }
}
