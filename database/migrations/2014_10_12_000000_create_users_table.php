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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('service_number',50)->nullable();
            $table->string('rank',50)->nullable();
            $table->string('surname')->nullable();
            $table->string('other_names')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('role',50)->default('admin');
            $table->foreignId('service_id')->nullable()->constrained('category_type_items')->index('fk_u_cti')->onDelete('set null'); // i.e ka, navy, kaf, civilian
            $table->foreignId('region_id')->nullable()->constrained('category_type_items')->index('fk_u_r')->onDelete('set null'); // Coast, Nairobi
            $table->foreignId('permission_group_id')->nullable()->constrained('permission_groups')->index('fk_u_pg')->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
