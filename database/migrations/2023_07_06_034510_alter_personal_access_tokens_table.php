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
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            if (!(Schema::hasColumn('personal_access_tokens', 'tokenable_type') && Schema::hasColumn('personal_access_tokens', 'tokenable_id'))) {
                $table->morphs('tokenable');
            }
            if (!Schema::hasColumn('personal_access_tokens', 'name')) {
                $table->string('name')->after('tokenable_id');
            }
            if (!Schema::hasColumn('personal_access_tokens', 'token')) {
                $table->string('token', 64)->unique()->after('name');
            }
            if (!Schema::hasColumn('personal_access_tokens', 'abilities')) {
                $table->text('abilities')->nullable()->after('token');
            }
            if (!Schema::hasColumn('personal_access_tokens', 'last_used_at')) {
                $table->timestamp('last_used_at')->nullable()->after('abilities');
            }
            if (!Schema::hasColumn('personal_access_tokens', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('last_used_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            //
        });
    }
};
