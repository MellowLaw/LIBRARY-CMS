<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('book_id'); // pending, approved, rejected, returned
            $table->text('rejection_reason')->nullable()->after('notes');
            $table->dateTime('approved_at')->nullable()->after('checkout_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['status', 'rejection_reason', 'approved_at']);
        });
    }
};
