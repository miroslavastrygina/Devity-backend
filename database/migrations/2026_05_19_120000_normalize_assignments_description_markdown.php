<?php

use App\Models\Assignment;
use App\Support\MarkdownText;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Assignment::query()->each(function (Assignment $assignment): void {
            $raw = $assignment->getAttributes()['description'] ?? null;

            if ($raw === null) {
                return;
            }

            $normalized = MarkdownText::normalize($raw);

            if ($normalized !== $raw) {
                $assignment->forceFill(['description' => $normalized])->saveQuietly();
            }
        });
    }

    public function down(): void
    {
        // Irreversible data normalization.
    }
};
