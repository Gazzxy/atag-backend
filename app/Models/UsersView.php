<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersView extends Model
{
    use Listable;

    protected $table = 'view_users';

    protected $casts = [
        'config' => 'array',
        'type_config' => 'array',
        'status_config' => 'array',
        'permissions' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'last_seen_at' => 'datetime:Y-m-d H:i:s',
        'expires_at' => 'datetime:Y-m-d'
    ];

    protected $orderable = [
        'id',
        'email'
    ];

    protected $searchable = [
        'full_name',
        'email',
        'client_title'
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

        return $view
            ->where('client_id', $client_id)
            ->where('deleted', 0)
            ->orderBy($by, $way)
            ->select('*')
            ->paginate($limit);
    }
}
