<?php

namespace App\Helpers\Traits\Request;

use App\DTO\SortOptionDTO;

trait Searchable
{
    public function getFilterQuery(): ?string
    {
        return $this->input('filter');
    }

    public function getSortOptions()
    {
        $sort_by = $this->input('sortBy.0', null);
        $sort_way = (bool)$this->input('sortDesc.0', false);

        return new SortOptionDTO([
            'sort_by' => $sort_by ?? 'id',
            'sort_way' => $sort_way ? 'DESC' : 'ASC'
        ]);
    }
}
