<?php

namespace App\Support;

final class MarkdownText
{
    /**
     * Преобразует литералы \r\n и экранированные последовательности в реальные переносы строк.
     */
    public static function normalize(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        $normalized = str_replace(['\\r\\n', '\\n', '\\r', '\\f'], ["\n", "\n", "\n", "\n"], $text);
        $normalized = stripcslashes($normalized);

        return str_replace(["\r\n", "\r"], "\n", $normalized);
    }
}
