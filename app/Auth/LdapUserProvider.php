<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Adldap\Laravel\Facades\Adldap;

class LdapUserProvider extends EloquentUserProvider
{
    /**
     * Override validateCredentials untuk menangani LDAP autentikasi.
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $password = $credentials['password'];
        $username = $credentials['username'];

        // Gunakan Adldap untuk memvalidasi username dan password
        if (Adldap::auth()->attempt($username, $password)) {
            return true;
        }

        return false;
    }
}
