<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Getter for username
    public function getUserName(): string
    {
        return $this->name;
    }
    
    public function scopeFindByUserName($query, string $username)
    {
        return $query->where('name', $username);
    }

    //Properties for roles
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Roles::class, 'user_roles');
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('role_name', $role)->exists();
    }

    // Properties for user images
    public function userImg()
    {
        return $this->hasOne(User_img::class);
    }
    public function getProfileImageAttribute()  // In blade file function is called profile_image
    {
        if ($this->userImg != null) {
            return asset('storage/' . $this->userImg->img);
        }
        return asset('img/profile-picture.png');
    }
}
