<?php
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Load the appropriate .env file based on APP_ENV
|--------------------------------------------------------------------------
|
| Here we will check the APP_ENV environment variable and load the
| corresponding .env file. This allows us to use environment-specific
| variables for local, production, or any other environment.
|
*/

$envFile = '.env'; // Default .env file

if (getenv('APP_ENV') === 'local' && file_exists($app->environmentPath() . DIRECTORY_SEPARATOR . '.env.local')) {
    $envFile = '.env.local';
} elseif (getenv('APP_ENV') === 'production' && file_exists($app->environmentPath() . DIRECTORY_SEPARATOR . '.env.production')) {
    $envFile = '.env.production';
}

// Log the environment file being used
error_log("Loading environment file: " . $envFile);

// Bind Important Interfaces...
$app->loadEnvironmentFrom($envFile);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;