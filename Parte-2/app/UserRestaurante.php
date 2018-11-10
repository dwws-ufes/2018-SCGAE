<?php

namespace App;

class UserRestaurante extends User
{
    protected $table = 'users';

    /**
     * Get the restaurante record associated with the user.
     */
    public function restaurante()
    {
        return $this->hasOne('App\Restaurante', 'user_id');
    }
}
