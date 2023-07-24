<?php

use App\TemplatingEngine\Cleaner;
use App\TemplatingEngine\KeyValueGenerator;
use App\TemplatingEngine\Matcher;

it('generates key value only for allowed classes', function () {
    $texts = [
        'valid' => '${ user.name } | ${ user.email } | ${ user2.name } | ${ user2.email }',
    ];

    $matcher = new Matcher();
    $cleaner = new Cleaner();
    $generator = new KeyValueGenerator();
    $generator->generate(
        $cleaner->cleanup(
            $matcher->match($texts['valid'])
        )
    );
});
