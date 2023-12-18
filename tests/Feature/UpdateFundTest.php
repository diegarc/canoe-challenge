<?php

use App\Models\Fund;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates a fund', function () {
    $manager = Manager::factory()->create();
    $fund = Fund::factory()->create();

    $payload = [
        'name' => 'testing',
        'manager_id' => $manager->id,
        'started_at' => 2000,
    ];

    $response = $this->put('/api/funds/' . $fund->id, $payload);

    $response->assertStatus(200);

    $fund = [...$payload, 'id' => $fund->id];

    $this->assertDatabaseHas('funds', $fund);
});