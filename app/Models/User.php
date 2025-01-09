<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany likes()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany likedBy()
 */
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
        'id',
        'name',
        'email',
        'gender',
        'hobby',
        'instagram',
        'phone_number',
        'criteria',
        'fee_for_register',
        'fund',
        'visibility',
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

    protected $appends = ['likes', 'likedBy'];

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

    /**
     * Users liked by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'liked_user_id')->withTimestamps();;
    }

    /**
     * Users who liked this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'liked_user_id', 'user_id')->withTimestamps();;
    }
}
