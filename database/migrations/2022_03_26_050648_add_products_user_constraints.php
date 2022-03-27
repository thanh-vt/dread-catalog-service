<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsUserConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('status', false, true);
            $table->smallInteger('type', false, true);
            $table->unique(array('name', 'type'), 'name_type_idx');
            $table->unique(array('email', 'type'), 'email_type_idx');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'seller_id')
                ->index('product_seller_fk_idx')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->unique(array('code', 'seller_id'), 'code_seller_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(array('name_type_idx', 'email_type_idx'));
            $table->dropColumn(array('status', 'type'));
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(array('product_seller_fk_idx', 'code_seller_idx'));
            $table->dropConstrainedForeignId('seller_id');
        });
    }
}
