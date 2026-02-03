<?php

namespace App\Models\User;

use App\Models\Cities\Cities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class UserInfo extends Model
{
    /** @use HasFactory<\Database\Factories\UserInfoFactory> */
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'city_id',
        'zip',
        'description',
        'address',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
}
