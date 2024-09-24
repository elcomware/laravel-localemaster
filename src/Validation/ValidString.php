<?php

namespace Elcomware\LocaleMaster\Validation;

class ValidString
{
    public static function check(string $value): bool
    {
        return self::checker($value);

    }

    public static function checkArray(array $input): bool
    {
        if (! empty($input)) {
            foreach ($input as $value) {
                return self::checker($value);
            }

        }

        return false;
    }

    private static function checker($value): bool
    {
        // Check if the input is null

        if (is_null($value)) {
            return false; // Invalid: input is null
        }

        // Check if the input is a string
        if (! is_string($value)) {
            return false; // Invalid: input is not a string
        }

        // Trim whitespace from the input
        $value = trim($value);

        // Check if the input is empty
        if (empty($value)) {
            return false; // Invalid: input is empty after trimming
        }

        // Check for potential malicious code (basic examples)
        $maliciousPatterns = [
            '/<script.*?<\/script>/i', // HTML script tags
            '/SELECT.*?FROM/i',        // SQL Injection attempt
            '/INSERT.*?INTO/i',
            '/UPDATE.*?SET/i',
            '/DELETE.*?FROM/i',
            '/UNION.*?SELECT/i',
            '/--/',                     // SQL comment
            '/#/',                      // Another SQL comment
        ];

        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return false; // Invalid: malicious content found
            }
        }

        // If all checks pass, return true
        return true;
    }
}
