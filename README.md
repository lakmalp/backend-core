# Premialabs backend package

## Installation

1. Create new Laravel project with correct laravel framework version.
```
composer create-project laravel/laravel="x.y.z" <PROJECT_NAME>
```

2. Update `composer.json` as below:
```json
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/lakmalp/backend-core.git"
    }
  ],
  "require": {
    "lakmalp/backend-core": "<SPECIFIC_TAG>"
  }
}
```
Note: Refer to description of `SPECIFIC_TAG` in repo for packages it depends on. Project packages (laravel and fortify) should match with the **backend-core** dependent packages.

3. Add below entries to `.env`
```
SANCTUM_STATEFUL_DOMAINS=<CLIENT_HOST:PORT>
SESSION_DOMAIN=localhost

DB_DATABASE=<DATABASE_NAME>
DB_USERNAME=<DATABASE_USER>
DB_PASSWORD=<DATABASE_PASSWORD>
```

4. Run
```
composer require laravel/fortify
```

5. Run
```
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
```

6. Update `'providers'` key of `config/app.php` with 
```
App\Providers\FortifyServiceProvider::class
```

7. Update `'paths'` in `config/cors.php` with 
```
'api/*', 'login', 'logout', 'sanctum/csrf-cookie', 'auth/resetPassword'
```

8. Update `config/cors.php` as
```
'supports_credentials' => true,
```

9. Update `config/fortify.php` as
```
'views' => false,
```

10. Update `'api'` key of `$middlewareGroups` in `App/Http/Kernel.php` with
```
\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
```

11. Run
```
php artisan migrate
```

12. Create `Src\_Config\AuditableModels.php` with
```php
namespace App\Src\_Config;

class AuditableModels
{
  public static function getAll()
  {
    return [];
  }
}
```
