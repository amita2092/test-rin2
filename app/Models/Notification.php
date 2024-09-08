<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'short_text',
        'expiration',
        'read',
        'created_by',
        'user_id'
    ];

    // A notification is created by one user
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // A notification can be sent to many users
    public function recipients()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
