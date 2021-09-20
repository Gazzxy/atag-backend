<?php

namespace App\Http\Actions\v1\Dashboard;

use App\Models\User;
use App\Models\Client;
use App\Models\EquipmentView;
use App\Models\EquipmentReportView;

class Statistics
{
    protected array $response;

    public function execute(User $user): self
    {
        $this->response = [
            'clients' => Client::statistics($user),
            'users' => User::statistics($user),
            'equipment' => EquipmentView::statistics($user),
            'reports' => EquipmentReportView::count()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
