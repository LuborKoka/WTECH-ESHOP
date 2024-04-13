<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('images')->nullable();
            $table->text('title');
            $table->string('publisher', 20);
            $table->timestampTZ('released_at')->default(DB::raw('NOW()'));
            $table->integer('stock')->default(0);
            $table->double('cost')->default(0);
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->unique(['title', 'author_id']);
            $table->timestampTZ('created_at')->default(DB::raw('NOW()'));
            $table->timestampTZ('updated_at')->default(DB::raw('NOW()'));
        });

        DB::statement('ALTER TABLE books ADD CONSTRAINT stock_not_negative CHECK(stock >= 0);');

        DB::statement('
            CREATE TRIGGER update_updated_at_trigger
            BEFORE UPDATE ON books
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
