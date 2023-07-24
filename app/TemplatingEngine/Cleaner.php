<?php

namespace App\TemplatingEngine;

class Cleaner
{
    public function cleanup(array $matches): array
    {
        $matches[0] = array_filter($matches[0], fn($match) => $this->isCorrect($match));
        $matches[1] = array_filter($matches[1], fn($match) => $this->isCorrect($match));
        return $matches;
    }

    private function isCorrect(string $match): bool
    {
        if ($this->hasDoubleDots($match)) {
            return false;
        }

        if ($this->hasDoubleUnderscores($match)) {
            return false;
        }

        if ($this->hasUnderscoreDot($match)) {
            return false;
        }

        if ($this->hasDotUnderscore($match)) {
            return false;
        }

        if ($this->hasDigitDotDigit($match)) {
            return false;
        }

        if ($this->hasDigitUnderscoreDigit($match)) {
            return false;
        }

        if ($this->hasDotDigitDot($match)) {
            return false;
        }

        if ($this->hasDotDigitUnderscore($match)) {
            return false;
        }

        return true;
    }

    private function hasDoubleDots(string $match): bool
    {
        return stripos($match, '..') !== false;
    }

    private function hasDoubleUnderscores(string $match): bool
    {
        return stripos($match, '__') !== false;
    }

    private function hasUnderscoreDot(string $match): bool
    {
        return stripos($match, '_.') !== false;
    }

    private function hasDotUnderscore(string $match): bool
    {
        return stripos($match, '._') !== false;
    }

    private function hasDigitDotDigit(string $match): bool
    {
        return preg_match('/\d\.\d/', $match);
    }

    private function hasDigitUnderscoreDigit(string $match): bool
    {
        return preg_match('/\d_\d/', $match);
    }

    private function hasDotDigitDot(string $match): bool
    {
        return preg_match('/\.\d\./', $match);
    }

    private function hasDotDigitUnderscore(string $match): bool
    {
        return stripos($match, '._') !== false;
    }
}
