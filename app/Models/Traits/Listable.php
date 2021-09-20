<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

trait Listable
{
    public static function listing(int $limit = 5, string $filter = null, string $order_by = 'id', string $order_way = 'DESC'): LengthAwarePaginator
    {
        $view = new static;

        $by = in_array($order_by, $view->orderable) ? $order_by : 'id';

        $way = $order_way === 'DESC' ? 'DESC' : 'ASC';

        if($filter && is_array($view->searchable))
        {
            foreach($view->searchable as $column)
            {
                $view = $view->orWhere($column, 'LIKE', '%' . $filter .'%');
            }
        }

        $view = $view->where('deleted', 0)->orderBy($by, $way);

        return $view->select('*')->paginate($limit);
    }
}
