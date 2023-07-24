<?php

use App\TemplatingEngine\Matcher;

it('returns correct matches', function () {
    $texts = [
        'valid' => '${ user.name } | ${ user.email } | ${ user.1st.2nd } | ${ user.1st.2nd.3rd } | ${ user.1st_2nd_3rd } | ${ user2.name } | ${ user2.email } | ${ user2.1st.2nd }',
        'valid_before_cleanup' => '${ user..name } | ${ user.__name } | ${ user._name } | ${ user.1.name } | ${ user.1.2 } | ${ user.1_2 } | ${ user.1.2.3 } | ${ user.1_2_3 }',
        'invalid' => '${ user. } ${ .user } ${user} {user} ${user ${user } ${ user} ${} ${ } {} $ user ${ :user }',
    ];
    $matcher = new Matcher();

    $this->assertEquals(
        expected: $matcher->match($texts['valid'])[0],
        actual: explode(' | ', $texts['valid'])
    );

    $this->assertEquals(
        expected: $matcher->match($texts['valid_before_cleanup'])[0],
        actual: explode(' | ', $texts['valid_before_cleanup'])
    );

    $this->assertEquals(
        expected: $matcher->match($texts['valid'])[1],
        actual: explode('|', str_replace(['$', '{', '}', ' '], '', $texts['valid']))
    );

    $this->assertEquals(
        expected: $matcher->match($texts['valid_before_cleanup'])[1],
        actual: explode('|', str_replace(['$', '{', '}', ' '], '', $texts['valid_before_cleanup']))
    );

    $this->assertEmpty($matcher->match($texts['invalid'])[0]);
    $this->assertEmpty($matcher->match($texts['invalid'])[1]);
});
