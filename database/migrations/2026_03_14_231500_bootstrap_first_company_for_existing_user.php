<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $user = DB::table('users')->whereNull('company_id')->orderBy('id')->first();

        if (! $user) {
            return;
        }

        $companyName = 'Empresa Inicial';
        $companySlug = 'empresa-inicial';

        $existingCompany = DB::table('companies')
            ->where('slug', $companySlug)
            ->first();

        if (! $existingCompany) {
            $companyId = DB::table('companies')->insertGetId([
                'name' => $companyName,
                'slug' => $companySlug,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $companyId = $existingCompany->id;
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'company_id' => $companyId,
                'role' => $user->role ?: 'platform_admin',
                'status' => $user->status ?: 'active',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        //
    }
};
