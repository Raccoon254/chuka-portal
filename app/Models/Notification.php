<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'message', 'to', 'read_by', 'total_users'];

    protected $casts = [
        'to' => 'json',
        'read_by' => 'json',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'notification_user');
    }

    public function readPercentage(): float|int
    {
        if ($this->total_users > 0) {
            return count($this->read_by) / $this->total_users * 100;
        }
        return 0;
    }

    public function scopeForUser($query, $userId)
    {
        return $query->whereJsonContains('to', (string) $userId);
    }

    public function scopeUnreadForUser($query, $userId)
    {
        return $query->forUser($userId)
            ->whereNull("read_by->{$userId}");
    }

    public function scopeReadForUser($query, $userId)
    {
        return $query->forUser($userId)
            ->whereNotNull("read_by->{$userId}");
    }

    public function scopeAllForUser($query, $userId)
    {
        return $query->forUser($userId);
    }

    public function isReadByUser($userId): bool
    {
        $readByUsers = $this->read_by ?? [];

        return in_array($userId, $readByUsers);
    }

}
