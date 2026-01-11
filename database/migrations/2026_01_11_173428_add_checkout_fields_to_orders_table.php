<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('orders', function (Blueprint $table) {

        if (!Schema::hasColumn('orders', 'shipping_address')) {
            $table->text('shipping_address')->after('total_price');
        }

        if (!Schema::hasColumn('orders', 'payment_method')) {
            $table->string('payment_method')->after('shipping_address');
        }

        if (!Schema::hasColumn('orders', 'status')) {
            $table->string('status')->default('pending')->after('payment_method');
        }
    });
}

   public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {

        if (Schema::hasColumn('orders', 'shipping_address')) {
            $table->dropColumn('shipping_address');
        }

        if (Schema::hasColumn('orders', 'payment_method')) {
            $table->dropColumn('payment_method');
        }

        if (Schema::hasColumn('orders', 'status')) {
            $table->dropColumn('status');
        }
    });
}
};
