<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')
                ->nullable(true)
                ->comment('Category code');
            $table->string('name')
                ->nullable(false)
                ->comment('Category name');
            $table->string('description')
                ->nullable(true)
                ->comment('Category description');
            $table->foreignIdFor(Category::class, 'parent_id')
                ->nullable(true)
                ->index('categories_self_ref_idx')
                ->constrained('categories')
                ->nullOnDelete();
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
        Schema::dropIfExists('categories');
    }
}
