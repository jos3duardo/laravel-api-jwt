<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * This route return a token of user if he can login credentials correct
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        $token = \JWTAuth::attempt($credentials);

        return $this->reponseToken($token);
    }

    /**
     * The method validate the token
     *
     * @param $token
     * @return array|\Illuminate\Http\JsonResponse
     */
    private function reponseToken($token){
        return $token ? ['token' => $token] :
            response()->json([
                'error' => \Lang::get('auth.failed')
            ],400);
    }

    /**
     * Return a list of users
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function users(){
        return User::all();
    }

    /**
     * Make logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function logout()
    {
        \Auth::guard('api')->logout();
        return response()->json([], 204);
    }


}
