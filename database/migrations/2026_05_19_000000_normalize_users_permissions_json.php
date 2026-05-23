<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::query()
            ->whereNotNull('permissions')
            ->each(function (User $user): void {
                $permissions = $user->permissions;

                if ($permissions === null) {
                    return;
                }

                $user->permissions = $permissions;
                $user->saveQuietly();
            });
    }

    public function down(): void
    {
        // Irreversible data normalization.
    }
};
