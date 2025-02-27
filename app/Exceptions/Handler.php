<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function unauthenticated($request, AuthenticationException $exception)
{
    return response()->json(['error' => 'Unauthorized, you are not authenticated'], 401);
}



public function render($request, Throwable $exception)
{
    if ($exception instanceof ModelNotFoundException) {
        return response()->json(['error' => 'Resource not found'], 404);
    }

    return parent::render($request, $exception);
}

}
