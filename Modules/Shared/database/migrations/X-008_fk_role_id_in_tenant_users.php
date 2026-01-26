<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        /*Schema::table('tenant_users', function (Blueprint $table) {
            $table->foreign('role_id', 'tenant_users_role_id_fk')
                ->references('id')
                ->on('permission_roles')
                ->restrictOnDelete();
        });*/
    }

    public function down(): void
    {
        Schema::table('tenant_users', function (Blueprint $table) {
            $table->dropForeign('tenant_users_role_id_fk');
        });
    }
};
