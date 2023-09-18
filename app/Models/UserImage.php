<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_path',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

}
