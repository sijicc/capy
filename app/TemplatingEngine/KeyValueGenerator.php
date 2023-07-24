<?php

namespace App\TemplatingEngine;

use Arr;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Str;

class KeyValueGenerator
{
    private array $models = [];
    private array $modelFields = [];

    /** @throws Exception */
    public function __construct()
    {
        $this->getModels();
        $this->getModelFields();
    }

    public function generate(array $matches): array
    {
        dd($this->models, $this->modelFields, $matches);
        return $matches;
    }

    private function getModels(): array
    {
        ClassFinder::disablePSR4Vendors();

        $this->models = array_filter(
            ClassFinder::getClassesInNamespace('App\Models\\'),
            fn($class) => is_a($class, AllowsToGenerateForm::class, true),
        );

        return $this->models;
    }

    private function getModelFields(): array
    {
        $this->modelFields = Arr::mapWithKeys(
            $this->models,
            fn(string $model) => [
                Str::of($model)->afterLast('\\')->lower()->toString() => $model::getFields(),
            ]
        );

        return $this->modelFields;
    }
}
