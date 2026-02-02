<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_img extends Model
{
    /** @use HasFactory<\Database\Factories\UserImgFactory> */
    use HasFactory;
    protected $fillable = [
        'img',
        'user_id'
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
