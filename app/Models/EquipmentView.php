<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class EquipmentView extends Model
{
    use Listable;

    protected $table = 'view_equipment';

    protected $casts = [
        'metadata' => 'array',
        'installed_at' => 'datetime:Y-m-d H:i:s',
        'last_service_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'property_created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $orderable = [
        'id'
    ];

    protected $searchable = [
        'title',
        'property_title',
        'property_address',
        'client_title'
    ];

    public static function statistics(User $user)
    {
        if($user->isAdministrator())
        {
            return self::count();
        }
        else
        {
            return self::where('client_id', $user->client_id)->count();
        }
    }

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
