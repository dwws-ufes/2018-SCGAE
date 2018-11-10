<?php

namespace App;

class UserEscola extends User
{
    protected $table = 'users';

    /**
     * Get the escola record associated with the user.
     */
    public function escola()
    {
        return $this->hasOne('App\Escola', 'user_id');
    }
}
