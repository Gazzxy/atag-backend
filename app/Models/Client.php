<?php

namespace App\Models;

use App\DTO\ClientDTO;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'public_id',
        'status_id',
        'title',
        'description',
        'address',
        'theme',
        'expires_at',
        'deleted_at',
        'last_login_at'
    ];

    public $timestamps = true;

    protected $casts = [
        'theme' => 'array'
    ];

    /**
     * @param ClientDTO $dto
     * @return static
     */
    public static function createFromDTO(ClientDTO $dto): self
    {
        return static::create([
            'public_id' => Str::uuid(),
            'status_id' => $dto->statusID,
            'title' => $dto->title,
            'description' => $dto->description,
            'address' => $dto->address,
            'expires_at' => $dto->expires_at,
            'last_seen_at' => null,
            'last_login_at' => null
        ]);
    }

    public static function statistics(User $user)
    {
        if($user->isAdministrator())
        {
            return self::count();
        }
        else
        {
            return self::where('id', $user->client_id)->count();
        }
    }

    /**
     * @return bool
     */
    public function softDelete(): bool
    {
        $this->deleted_at = now();

        return $this->save();
    }

    public function setPending(): bool
    {
        $this->status_id = ClientStatus::S_PENDING;

        return $this->save();
    }

    public function setSuspended(): bool
    {
        $this->status_id = ClientStatus::S_SUSPENDED;

        return $this->save();
    }

    public function setExpired(): bool
    {
        $this->status_id = ClientStatus::S_EXPIRED;

        return $this->save();
    }

    public function setActive(): bool
    {
        $this->status_id = ClientStatus::S_ACTIVE;

        return $this->save();
    }

    public function isActive()
    {
        return $this->status_id === ClientStatus::S_ACTIVE;
    }
}
