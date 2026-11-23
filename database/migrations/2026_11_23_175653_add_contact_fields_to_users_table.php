<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'contact_phone')) {
                $table->string('contact_phone')->nullable();
            }

            if (!Schema::hasColumn('users', 'contact_email')) {
                $table->string('contact_email')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'contact_phone')) {
                $table->dropColumn('contact_phone');
            }

            if (Schema::hasColumn('users', 'contact_email')) {
                $table->dropColumn('contact_email');
            }
        });
    }
};
