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
