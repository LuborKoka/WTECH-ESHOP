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
            $table->text('address_addres');
            $table->string('zipcode', 5);
            $table->string('city', 35);
            $table->string('status', 15)->default('pending');
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
