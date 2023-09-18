<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reg_no',
        'name',
        'id_no',
        'gender',
        'address',
        'email',
        'dob',
        'campus',
        'current_programme',
        'attempted_units',
        'registered_units',
        'total_billed',
        'total_paid',
        'fee_balance',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'password' => 'hashed',
    ];


    public function unreadNotificationCount(): int
    {
        $unreadCount = 0;

        // Loop through each notification associated with the user
        $notifications = $this->allNotifications();
        foreach ($notifications as $notification) {
            if (!$notification->isReadByUser($this->id)) {
                $unreadCount++;
            }
        }

        return $unreadCount;
    }

    public function allNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::allForUser($this->id)->get();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function readNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::readForUser($this->id)->get();
    }

    public function getUnreadNotificationsAttribute(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->unreadNotifications();
    }

    //get unread notifications

    public function unreadNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::unreadForUser($this->id)->get();
    }
}
