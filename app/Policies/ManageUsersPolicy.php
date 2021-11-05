<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManageUsersPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function manageUsers(User $user) {
        return $user->hasRole('admin'); 
        /*nije mi blade provjera da li user može vidjeti "manage users" gumb 
        radila dok nisam stavio da se ovdje rola vraća kao array*/
    }
}
