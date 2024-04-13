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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('author_name', 45);
            $table->integer('count');
            $table->double('total_cost');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->timestampTZ('created_at')->default(DB::raw('NOW()'));
            $table->timestampTZ('updated_at')->default(DB::raw('NOW()'));
        });

        DB::statement('ALTER TABLE order_items ADD CONSTRAINT count_more_than_zero CHECK (count > 0);');
        DB::statement('
            CREATE TRIGGER update_updated_at_trigger
            BEFORE UPDATE ON order_items
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
