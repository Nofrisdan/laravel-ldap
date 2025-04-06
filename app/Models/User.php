<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Adldap\Laravel\Traits\HasLdapUser;

class User extends Authenticatable
{
    use HasLdapUser;

    protected $fillable = [
        'id',
        'name',
        'email',
        'username',
    ];
}
