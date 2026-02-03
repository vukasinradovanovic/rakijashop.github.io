<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Ads\Ads;
use App\Models\User\User;
use App\Models\User\UserInfo;

class Cities extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
    ];
    public function users()
    {
        return $this->hasMany(UserInfo::class,'city_id');
    }
}
