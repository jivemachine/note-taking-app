<?php

use Core\Validator;


it('Validates a string', function() {
    expect(\Core\Validator::string('foobar'))->toBeTrue();
    expect(\Core\Validator::string(false))->toBefalse();
    expect(\Core\Validator::string(''))->toBefalse();
});

it('Validates a string with a minimum length', function() {
    expect(\Core\Validator::string('foobar', 20))->toBeFalse();
});


it('Validates an email', function() {
    expect(\Core\Validator::email('foobar'))->toBeFalse();
    expect(\Core\Validator::email('foobar@example.com'))->toBeTrue();
});


it('Validates that a number is greater than a given amount', function() {
    expect(Validator::greaterThan(10, 1))->toBeTrue();
    expect(Validator::greaterThan(10, 100))->toBeFalse();
})->only();