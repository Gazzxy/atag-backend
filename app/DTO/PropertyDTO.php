<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class PropertyDTO extends DataTransferObject
{
    public ?int $client_id;
    public string $title;
    public ?string $description;
    public ?string $address_formatted;
    public ?string $address_line_1;
    public ?string $address_line_2;
    public ?string $city;
    public ?string $postcode;
}
