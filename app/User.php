<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Events\UserCreatedEvent;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

     /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreatedEvent::class,
        
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

    //relacija usera na više stranica
    public function pages() {
        return $this->hasMany('App\Page');
    }

    //relacija role na više usera
    public function roles() {
        return $this->belongsToMany('App\Role');
    }

    public function isAdminOrEditor() {
        return $this->hasAnyRole(['admin','editor']);
    }

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /*public function hasRole($role) {
        return null !== $this->roles()->whereIn('name', $role)->first();
        
    }*/
    public function hasRole($role) {
        $roles = $this->roles()->where('name' , $role)->count();
            if ($roles ==1) {
                return true;
            } return false;
    }
}
