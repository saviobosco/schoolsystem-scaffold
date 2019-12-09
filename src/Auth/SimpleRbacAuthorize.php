<?php
namespace App\Auth;

use Cake\Http\ServerRequest;
use Cake\Utility\Hash;
use CakeDC\Auth\Auth\SimpleRbacAuthorize as BaseAuthorize;

class SimpleRbacAuthorize extends BaseAuthorize {

    public function authorize($user, ServerRequest $request)
    {
        if (empty(Hash::get($user, 'role'))) {
            return false;
        }
        return parent::authorize($user, $request);
    }
}