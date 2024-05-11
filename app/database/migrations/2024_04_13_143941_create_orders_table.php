<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('shipping_address');
            $table->string('zipcode', 5);
            $table->string('city', 35);
            $table->integer('payment_method');
            $table->integer('shipping_method');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('email', 320);
            $table->string('phone_number', 13);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestampTZ('created_at')->default(DB::raw('NOW()'));
            $table->timestampTZ('updated_at')->default(DB::raw('NOW()'));
        });

        DB::statement('
            CREATE TRIGGER update_updated_at_trigger
            BEFORE UPDATE ON orders
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
