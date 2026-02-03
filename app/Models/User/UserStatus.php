<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    /** @use HasFactory<\Database\Factories\UserStatusFactory> */
    use HasFactory;

    protected $table = 'user_statuses';
    
    protected $fillable = [
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
