<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;

class DebugController extends Controller
{
    //
    public function ldap_debug()
    {
        try {
            // Tentukan base DN
            $baseDn = 'ou=People,dc=cakdunsite,dc=local';
            $username = "nofrisdan";

            // Gunakan query pencarian untuk mendapatkan pengguna
            $results = Adldap::search()
                ->where("uid", $username)
                ->first();

            dd($results->getCommonName());
            // check if not empty 
            if ($results->isNotEmpty()) {
                $user = $results->first();
                dd([
                    "username" => $user->getCommonName(),
                    "email" => $user->getEmail()
                ]);
            } else {
                return False;
            }
        } catch (\Exception $e) {
            dd('LDAP Error: ' . $e->getMessage());
        }
    }
}
