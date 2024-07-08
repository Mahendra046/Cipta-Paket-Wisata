<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Destinasi;
use App\Models\User;

class DestinasiPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Destinasi $destinasi)
    {
        return $user->id === $destinasi->user_id;
    }

    public function update(User $user, Destinasi $destinasi)
    {
        return $user->id === $destinasi->user_id;
    }

    public function delete(User $user, Destinasi $destinasi)
    {
        return $user->id === $destinasi->user_id;
    }
}
