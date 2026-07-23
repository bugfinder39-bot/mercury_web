<?php

test('returns a successful response', function () {
    $this->seed();
    $response = $this->get(route('home'));

    $response->assertOk();
});