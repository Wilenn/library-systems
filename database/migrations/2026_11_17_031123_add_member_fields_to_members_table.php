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
    Schema::table('members', function (Blueprint $table) {
        $table->string('member_code')->nullable()->unique()->after('name');
        $table->string('phone')->nullable()->after('member_code');
        $table->text('address')->nullable()->after('phone');
    });
}

public function down(): void
{
    Schema::table('members', function (Blueprint $table) {
        $table->dropUnique(['member_code']);
        $table->dropColumn(['member_code', 'phone', 'address']);
    });
}
};
