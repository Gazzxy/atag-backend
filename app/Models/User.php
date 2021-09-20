<?php

namespace App\Models;

use Identicon;
use Illuminate\Support\Arr;
use App\DTO\ManagingAccountDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_administrator',
        'status_id',
        'type_id',
        'client_id',
        'full_name',
        'email',
        'password',
        'config',
        'expires_at',
        'last_login_at',
        'deleted_at',
        'last_seen_at',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'config' => 'array'
    ];

    /**
     * @param ManagingAccountDTO $dto
     * @return static
     */
    public static function createFromDTO(ManagingAccountDTO $dto): self
    {
        return static::create([
            'client_id' => $dto->client_id,
            'status_id' => UserStatus::S_PENDING,
            'type_id' => $dto->type_id,
            'full_name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->hashed_password,
            'expires_at' => $dto->expires_at,
            'config' => [
                'requireEmailConfirmation' => $dto->requireEmailConfirmation,
                'autoGeneratePassword' => $dto->autoGeneratePassword,
                'requirePasswordChangeOnFirstLogin' => $dto->requirePasswordChangeOnFirstLogin,
                'passwordChangedOnFirstLogin' => false,
            ]
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
            return self::where('client_id', $user->client_id)->count();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return 1 === (int)$this->is_administrator;
    }

    /**
     * @return bool
     */
    public function isManagingAccount(): bool
    {
        return $this->type_id === ClientAccountType::T_MANAGING_ACCOUNT;
    }

    /**
     * @return bool
     */
    public function isUserAccount(): bool
    {
        return $this->type_id === ClientAccountType::T_USER_ACCOUNT;
    }

    /**
     * @return bool
     */
    public function requirePasswordChangeOnFirstLogin(): bool
    {
        return Arr::get($this->config, 'requirePasswordChangeOnFirstLogin', false);
    }

    /**
     * @return bool
     */
    public function passwordChangedOnFirstLogin(): bool
    {
        return Arr::get($this->config, 'passwordChangedOnFirstLogin', false);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        $client = $this->client;

        if(empty($client)) return 'None';

        return $client->title;
    }

    public function getClientID()
    {
        return $this->client_id;
    }

    public function getAvatar()
    {
        return Identicon::getImageDataUri($this->getEmail());
    }

    /**
     * @param bool $which
     * @return bool
     */
    public function setRequirePasswordChange(bool $which): bool
    {
        $config = array_merge($this->config, ['requirePasswordChangeOnFirstLogin' => $which]);

        $this->config = $config;

        return $this->save();
    }

    /**
     * @return bool
     */
    public function markLoggedIn(): bool
    {
        $this->last_login_at = now()->format('Y-m-d H:i:s');

        return $this->save();
    }

    /**
     * @return bool
     */
    public function setPending(): bool
    {
        $this->status_id = UserStatus::S_PENDING;

        return $this->save();
    }

    /**
     * @return bool
     */
    public function setSuspended(): bool
    {
        $this->status_id = UserStatus::S_SUSPENDED;

        return $this->save();
    }

    /**
     * @return bool
     */
    public function setExpired(): bool
    {
        $this->status_id = UserStatus::S_EXPIRED;

        return $this->save();
    }

    /**
     * @return bool
     */
    public function setActive(): bool
    {
        $this->status_id = UserStatus::S_ACTIVE;

        return $this->save();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status_id === UserStatus::S_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return !empty($this->deleted_at);
    }

    public function isSuspended(): bool
    {
        return $this->status_id === UserStatus::S_SUSPENDED;
    }

    public function isExpired(): bool
    {
        return $this->status_id === UserStatus::S_EXPIRED;
    }

    /**
     * @return bool
     */
    public function markSeen(): bool
    {
        $this->last_seen_at = now();

        return $this->save();
    }

    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        $result = false;

        try
        {
            $query = DB::select("
                SELECT
                p.id AS permission_id,
                u.id AS user_id

                FROM permissions p

                INNER JOIN users2permissions u2p
                ON u2p.permission_id = p.id

                INNER JOIN users u
                ON u.id = u2p.user_id

                WHERE u.id = ? AND p.permission = ?
                ", [$this->id, $permission]);

            $result = !empty($query);
        }
        catch(\Exception $e)
        {

        }

        return $result;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function updateEmail(string $email): bool
    {
        $this->email = $email;

        return $this->save();
    }

    /**
     * @param string $password
     * @return bool
     */
    public function updatePassword(string $password): bool
    {
        $this->password = password_hash($password, PASSWORD_ARGON2I);

        return $this->save();
    }

    /**
     * @return bool
     */
    public function softDelete(): bool
    {
        $this->deleted_at = now();

        return $this->save();
    }

    public function grantAllPermissions()
    {
        return DB::statement("INSERT INTO users2permissions (user_id, permission_id) SELECT ?, id FROM permissions", [$this->id]);
    }

    public function setAsManagingAccount(): bool
    {
        $this->type_id = ClientAccountType::T_MANAGING_ACCOUNT;

        return $this->save();
    }
}
