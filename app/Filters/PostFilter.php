<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostFilter
{
    protected Builder $builder;
    protected Request $request;

    public function __construct(Builder $builder, Request $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply(): Builder
    {
        return $this
            ->filterByCategory()
            ->filterBySearch()
            ->builder;
    }

    protected function filterByCategory(): self
    {
        $categoryId = $this->request->input('category');

        if ($categoryId) {
            $this->builder->whereHas('categories', fn ($q) =>
                $q->where('categories.id', $categoryId)
            );
        }

        return $this;
    }

    protected function filterBySearch(): self
    {
        $search = $this->request->input('q');

        if ($search) {
            $this->builder->whereHas('translations', fn ($q) =>
                $this->applySearch($q, $search)
            );
        }

        return $this;
    }

    private function applySearch($query, string $text)
    {
        return  $query->where(function ($q) use ($text) {
            $q->where('title', 'ILIKE', "%{$text}%")
            ->orWhere('content', 'ILIKE', "%{$text}%");
        });
    }
}
