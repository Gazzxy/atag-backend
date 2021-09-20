<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Property;
use App\Models\Equipment;
use Illuminate\Database\Seeder;
use App\Models\ClientAccountType;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    public function run()
    {
        $clients = DB::transaction(function()
        {
            return Client::factory(30)->create();
        });

        foreach($clients as $client)
        {
            printf("\nClient: %d", $client->id);

            DB::transaction(function() use ($client)
            {
                $user = User::factory(rand(5, 12))->create([
                    'client_id' => $client->id,
                    'type_id' => ClientAccountType::T_USER_ACCOUNT
                ]);

                $properties = Property::factory(rand(5, 10))->create([
                    'client_id' => $client->id
                ]);

                foreach($properties as $property)
                {
                    Equipment::factory(rand(5, 10))->create([
                        'property_id' => $property->id
                    ]);
                }
            });
        }
    }
}
