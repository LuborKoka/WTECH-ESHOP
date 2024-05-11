<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        DB::statement('CREATE EXTENSION IF NOT EXISTS unaccent');
    }

    public function down() {
        DB::statement('DROP EXTENSION IF EXISTS unaccent');
    }
};
