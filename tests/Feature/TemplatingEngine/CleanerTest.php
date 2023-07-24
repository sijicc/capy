<?php

use App\TemplatingEngine\Cleaner;
use App\TemplatingEngine\Matcher;

it('performs cleanup', function () {
    $texts = [
        'valid' => '${ user.name } | ${ user.email } | ${ user2.name } | ${ user2.email }',
        'valid_before_cleanup' => '${ user..name } | ${ user.__name } | ${ user._name } | ${ user.1.name } | ${ user.1.2 } | ${ user.1_2 } | ${ user.1.2.3 } | ${ user.1_2_3 }',
        'invalid' => '${ user. } ${ .user } ${user} {user} ${user ${user } ${ user} ${} ${ } {} $ user ${ :user }',
    ];

    $matcher = new Matcher();
    $cleaner = new Cleaner();

    $this->assertEquals(
        expected: explode(' | ', $texts['valid']),
        actual: $cleaner->cleanup($matcher->match($texts['valid']))[0]
    );

    $this->assertEquals(
        expected: explode('|', str_replace(['$', '{', '}', ' '], '', $texts['valid'])),
        actual: $cleaner->cleanup($matcher->match($texts['valid']))[1]
    );

    $this->assertEmpty(
        $cleaner->cleanup($matcher->match($texts['invalid']))[0]
    );
    $this->assertEmpty(
        $cleaner->cleanup($matcher->match($texts['invalid']))[1]
    );
    $this->assertEmpty(
        $cleaner->cleanup($matcher->match($texts['valid_before_cleanup']))[0]
    );
    $this->assertEmpty(
        $cleaner->cleanup($matcher->match($texts['valid_before_cleanup']))[1]
    );
});
