<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'birth_date', 'calification','address', 'phone','password','role_id', 'FMCToken',
        "type_chef", "have_restaurant_or_foodPoint", 'lastName'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function schedulesByChef()
    {
        return $this->hasMany(Order::class, "chef_id");
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeDiners(Builder $query)
    {
        $query = $query->where("role_id", "=", 2);

        return $query->get();
    }

    public function scopeChefs(Builder $query)
    {
        $query = $query->where("role_id", "=", 1);

        return $query->get();
    }

}
