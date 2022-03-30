<?php


namespace App\Repositories\Impl;


use App\Models\User;
use App\Repositories\UserRepository;
use Throwable;

class UserRepositoryImpl implements UserRepository
{

    /**
     * @throws Throwable
     */
    public function getUserInfo(User $user): User
    {
        // TODO: Implement getUser() method.         $user = Auth::guard('api')->user();
        $existedUser = User::whereName($user->name)->whereType($user->type)->first();
        if ($existedUser != null) {
            return $existedUser;
        } else {
            $user->saveOrFail();
            return $user;
        }
    }
}
