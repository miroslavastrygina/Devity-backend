<?php

use App\Models\TestQuestion;
use App\Support\MarkdownText;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        TestQuestion::query()->each(function (TestQuestion $testQuestion): void {
            $raw = $testQuestion->getAttributes()['question'] ?? null;

            if ($raw === null) {
                return;
            }

            $normalized = MarkdownText::normalize($raw);

            if ($normalized !== $raw) {
                $testQuestion->forceFill(['question' => $normalized])->saveQuietly();
            }
        });
    }

    public function down(): void
    {
        // Irreversible data normalization.
    }
};
