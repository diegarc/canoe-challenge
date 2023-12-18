<?php

use App\Models\Fund;
use App\Models\Manager;
use App\Models\Alias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Events\DuplicatedFund;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

it('updates a fund', function () {
    $manager = Manager::factory()->create();

    $payload = [
        'name' => 'testing',
        'manager_id' => $manager->id,
        'started_at' => 2000,
    ];

    $response = $this->post('/api/funds/', $payload);

    $response->assertStatus(201);

    $this->assertDatabaseHas('funds', $payload);
});

it('fires a duplicated fund event for duplicated name', function () {
    $fund = Fund::factory()->create();

    $payload = [
        'name' => $fund->name,
        'manager_id' => $fund->manager_id,
        'started_at' => 2000,
    ];

    Event::fake();

    $response = $this->post('/api/funds', $payload);

    Event::assertDispatched(DuplicatedFund::class);
});

it('fires a duplicated fund event for duplicated alias', function () {
    $fund = Fund::factory()->create();
    $alias = Alias::factory()->create(['fund_id' => $fund->id]);

    $payload = [
        'name' => $alias->name,
        'manager_id' => $fund->manager_id,
        'started_at' => 2000,
    ];

    Event::fake();

    $response = $this->post('/api/funds', $payload);

    Event::assertDispatched(DuplicatedFund::class);
});