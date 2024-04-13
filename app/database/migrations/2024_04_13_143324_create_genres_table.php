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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15)->unique();
            $table->timestampTZ('created_at')->default(DB::raw('NOW()'));
            $table->timestampTZ('updated_at')->default(DB::raw('NOW()'));
        });

        DB::statement('
            CREATE TRIGGER update_updated_at_trigger
            BEFORE UPDATE ON genres
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
};
