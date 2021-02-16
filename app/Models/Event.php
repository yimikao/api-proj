<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['theme', 'caption', 'date', 'time'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_id' => 'integer'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
