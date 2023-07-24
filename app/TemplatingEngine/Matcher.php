<?php

namespace App\TemplatingEngine;

class Matcher
{
    const PATTERN = '/\$\{ ((?![._])[a-zA-Z0-9_.]+(?<![_.])) }/';

    public function match(string $text): array
    {
        preg_match_all(self::PATTERN, $text, $matches);

        return $matches;
    }

    public function cleanup(array $matches): array
    {
        $performCleanup = function ($match) {
            if (stripos($match, '..') !== false) {
                return false;
            }

            if (stripos($match, '__') !== false) {
                return false;
            }

            if (stripos($match, '_.') !== false) {
                return false;
            }

            if (stripos($match, '._') !== false) {
                return false;
            }

            if (preg_match('/\d\.\d/', $match)) {
                return false;
            }

            if (preg_match('/\d_\d/', $match)) {
                return false;
            }

            if (preg_match('/.\d./', $match)) {
                return false;
            }

            if (preg_match('/.\d_/', $match)) {
                return false;
            }

            return true;
        };

        $matches[0] = array_filter($matches[0], $performCleanup);
        $matches[1] = array_filter($matches[1], $performCleanup);

        return $matches;
    }
}
