<?php

namespace App\Services;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * Trait AuthRegisterUserApiTrait
 *
 * @package App\Services
 */
trait AuthRegisterUserApiTrait
{

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function validateUser(Request $request): mixed
    {

       return Validator::make($request->all(),
            [
                'role_id' => 'required|integer',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:password',
            ]);
    }

    /**
     * @param Request $request
     * @param int $roleId
     *
     * @return User
     */
    public function storeUser(Request $request): User
    {
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return $user;
    }

}
