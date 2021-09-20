<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class ClientDTO extends DataTransferObject
{
    public int $statusID;
    public ?int $client_id;
    public ?string $public_id;
    public string $title;
    public ?string $description;
    public ?string $address;
    public ?string $expires_at;
    public ?array $theme;

    public function toArray()
    {
        return [
            'status_id' => $this->statusID,
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'theme' => $this->theme,
            'expires_at' => $this->getExpiresAt()
        ];
    }

    protected function getExpiresAt(): ?string
    {
        if(empty($this->expires_at)) return null;

        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', $this->expires_at);

        if(false === $dt) return null;

        return $dt->format('y-m-d H:i:s');
    }
}
