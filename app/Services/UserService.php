<?php 

namespace App\Services;

use App\Models\User;
use Exception;
use Hamcrest\Core\AllOf;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class UserService {


    public const IMPERSONATE_USER_KEY = 'IMPERSONATE-USER-ID';

    /**
     * @param string $uuid 
     * @return void 
     * @throws Exception 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     */
    public function impersonateUser(string $uuid)
    {
        $impersonateUser = User::query()->where(User::FIELD_UUID, $uuid)->firstOrFail();
        $currentUser = Auth::user();

        if(!$impersonateUser) {
            throw new Exception('Invalid UUID of user to impersonate.');
        }

        if (!session(self::IMPERSONATE_USER_KEY)) {
            session([self::IMPERSONATE_USER_KEY => $currentUser->{User::FIELD_UUID}]);
        }
        
        Auth::loginUsingId($impersonateUser->{User::FIELD_ID});

        return redirect('/dashboard');
    }


    /**
     * @param string $uuid 
     * @return void 
     * @throws Exception 
     * @throws BindingResolutionException 
     * @throws NotFoundExceptionInterface 
     * @throws ContainerExceptionInterface 
     */
    public function stopImpersonateUser()
    {
        $uuid = session(self::IMPERSONATE_USER_KEY);
        $user = User::query()->where(User::FIELD_UUID, $uuid)->firstOrFail();

        if (!$user) {
            throw new Exception('Invalid user UUID.');
        }

        session()->forget(self::IMPERSONATE_USER_KEY);
        Auth::loginUsingId($user->{User::FIELD_ID});

        return redirect('/dashboard');
    }

}