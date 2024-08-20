<?php

use Core\Container;

test('It can resolve something out of the container', function () {
    // arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar');
    
    
    // act
    $result = $container->resolve('foo');
    
    
    // asset/expect
    expect($result)->toEqual('bar');
});

