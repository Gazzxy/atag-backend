<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PropertyView extends Model
{
    use Listable;

    protected $table = 'view_properties';

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $orderable = [
        'id'
    ];

    protected $searchable = [
        'title',
        'client_title',
        'address_formatted',
        'city'
    ];

    public static function listingFor(int $client_id, string $filter = null, int $limit = 5, string $order_by = 'id', string $order_way = 'DESC'): LengthAwarePaginator
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

        $view = $view
            ->where('client_id', $client_id)
            ->where('deleted', 0)
            ->orderBy($by, $way)
            ->select('*')
            ->paginate($limit);

        return $view;
    }
}
