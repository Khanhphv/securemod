<?php

namespace App;

use App\Events\UpdatedUserEvent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int credit
 * @property string type
 * @property int ref_user_id
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const SUPPORT_TYPE = 'support';
    const DEFAULT_TYPE = 'default';

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function isSupport()
    {
        return $this->type === self::SUPPORT_TYPE;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'credit',
        'phone',
        'ref_user_id',
        'user_debt',
        'user_ref_count',
        'provider',
        'provider_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'saved' => UpdatedUserEvent::class,
    ];
}
