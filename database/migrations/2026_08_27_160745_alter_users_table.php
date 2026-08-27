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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'first_name');
            }

            $table->string('last_name')->after('first_name');

            $table->string('mobile_number')->unique()->after('last_name');
            $table->string('mobile_number_country', 3)->after('mobile_number');
            $table->string('mobile_number_verification_code', 6)->nullable()->after('mobile_number_country');
            $table->timestamp('mobile_number_verified_at')->nullable()->after('mobile_number_verification_code');

            $table->boolean('term_accepted')->default(false)->after('password');

            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->after('term_accepted');

            $table->dateTime('last_login_at')->nullable()->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'first_name')) {
                $table->renameColumn('first_name', 'name');
            }

            $table->dropColumn('last_name');
            $table->dropColumn('mobile_number');
            $table->dropColumn('mobile_number_country');
            $table->dropColumn('mobile_number_verification_code');
            $table->dropColumn('mobile_number_verified_at');

            $table->dropColumn('term_accepted');

            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
