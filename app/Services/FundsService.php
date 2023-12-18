<?php

namespace App\Services;

use App\Models\Fund;
use Illuminate\Support\Collection;

class FundsService {
    public function list($filters): Collection
    {
        $query = Fund::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (isset($filters['manager'])) {
            $query->whereHas('manager', function ($query) use ($filters) {
                return $query->where('name', 'like', "%{$filters['manager']}%");
            });
        }

        if (isset($filters['year'])) {
            $query->where('started_at', $filters['year']);
        }

        return $query->get();
    }

    public function update(Fund $fund, array $payload): Fund
    {
        $fund->fill($payload)->update();

        return $fund;
    }
}