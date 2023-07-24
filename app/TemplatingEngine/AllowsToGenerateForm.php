<?php

namespace App\TemplatingEngine;

interface AllowsToGenerateForm
{
    public static function getFields(): array;
}
