<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentReportView extends Model
{
    protected $table = 'view_equipment_reports';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function statistics(User $user)
    {
        if($user->isAdministrator())
        {
            return self::count();
        }
        else
        {
            return 0;
        }
    }

    public static function getReportListFor(int $id): array
    {
        return self::where('equipment_id', $id)
            ->where('deleted', 0)
            ->orderBy('id', 'DESC')
            ->select('*')
            ->get()
            ->toArray()
            ;
    }

    public static function getReportListForByUUID(string $id): array
    {
        return self::where('public_id', $id)
            ->where('deleted', 0)
            ->orderBy('id', 'DESC')
            ->select('*')
            ->get()
            ->toArray()
            ;
    }
}
