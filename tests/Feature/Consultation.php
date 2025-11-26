<?php

it('has consultation page', function () {
    $response = $this->get('/consultation');

    $response->assertStatus(200);
});
