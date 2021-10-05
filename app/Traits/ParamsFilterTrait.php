<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder;

trait ParamsFilterTrait
{
    private function filter(array $allowed, array $params)
    {
        $filtered = [];
        foreach ($allowed as $key) {
            $filtered[$key] = array_key_exists($key, $params)
                ? $params[$key]
                : null;
        }
        return $filtered;
    }

    private function filters(array $allowed, array $params, Builder $query)
    {

        $filters = [];
        foreach ($allowed as $key) {
            $filters[$key] = in_array($key, $params)
                ? $params[$key]
                : null;
        }
        $this->build($filters, $query);
        return $filters;
    }

    private function build($filters,  Builder $query)
    {
        foreach ($filters as $key => $filter) {
            $query = $query->when($filter, function ($q, $filter) use ($key) {
                $q->where($key, $filter);
            });
        }
        return $query;
    }
}
