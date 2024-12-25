<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (HttpException $e, $request) {
            if ($e->getStatusCode() == 400) {
                return response()->view('errors.400', [], 400);
            } elseif ($e->getStatusCode() == 403) {
                return response()->view('errors.403', [], 403);
            } elseif ($e->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            } elseif ($e->getStatusCode() == 500) {
                return response()->view('errors.500', [], 500);
            } elseif ($e->getStatusCode() == 503) {
                return response()->view('errors.503', [], 503);
            }
        });
    }
}
