<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\database\QueryException;
use Illuminate\Validation\ConnectException;
use Throwable;


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
    public function render($request, Throwable $exception)
        {
            // Catch database connection errors
            if (
                $exception instanceof \PDOException ||
                $exception instanceof QueryException ||
                (class_exists('\Illuminate\Database\ConnectException') && $exception instanceof \Illuminate\Database\ConnectException)
            ) {
                // Show a custom error view or message
                return response()->view('errors.db', [], 500);
                // Or just return a simple message:
                // return response('Database connection error. Please try again later.', 500);
            }

            return parent::render($request, $exception);
        }

}
