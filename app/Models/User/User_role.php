<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    /** @use HasFactory<\Database\Factories\UserRoleFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
