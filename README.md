<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## API whit JWT

steps for using JWT whit authentication
```bash
composer require tymon/jwt-auth
```
in file config/auth.php change the driver for **jwt**
```bash
  'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
```
in mode of User implements this interface and add 2 functions in file
```bash
class User extends Authenticatable implements JWTSubject

 /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
```

generate a new token jwt with command
```bash
php artisan jwt:secret
```
in laravel 7.x is necessary to use the command bellow. 

```bash
composer require laravel/ui "^2.0"
```

make command 
```bash
php artisan migrate --seed
```

configuration routes for access the application in file routes/api.php
```bash
Route::post('login', 'Api\AuthController@login');

//token is necessary for access this route
Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('users', 'AuthController@users');
});
``` 

