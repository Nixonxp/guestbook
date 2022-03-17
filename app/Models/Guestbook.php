<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment'
    ];

    protected $appends = [
        'guest_name'
    ];

    public function guest()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getGuestNameAttribute()
    {
        return $this->guest->name;
    }
}
