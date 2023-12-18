<?php

use App\Models\Fund;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('list all funds', function () {
    $funds = Fund::factory(10)->create();

    $response = $this->get('/api/funds');

    $response
        ->assertStatus(200)
        ->assertJson($funds->toArray());
});

it('list filtered funds', function () {
    $funds = [];

    $managers = Manager::factory(3)->create();

    $fund[] = Fund::factory()->create(['name' => 'fund 1', 'manager_id' => $managers[0]->id, 'started_at' => 2020]);
    $fund[] = Fund::factory()->create(['name' => 'fund 2', 'manager_id' => $managers[1]->id, 'started_at' => 2021]);
    $fund[] = Fund::factory()->create(['name' => 'fund 3', 'manager_id' => $managers[2]->id, 'started_at' => 2022]);

    Fund::factory(10)->create();

    $response = $this->get('/api/funds');

    $response
        ->assertStatus(200)
        ->assertJson($funds);
});