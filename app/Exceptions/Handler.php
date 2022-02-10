<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            return $this->handleApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }


    private function handleApiException($request, Throwable $exception)
    {
        // dd($exception);
        $exception = $this->prepareException($exception);

        if ($exception instanceof \App\Exceptions\AuthorizationException) {
            return $this->apiResponse('Unauthorized', 401);
        } else if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return $this->apiResponse('Unauthenticated', 401);
        } else if ($exception instanceof ValidationException) {
            return $this->apiResponse('Validation error', 422, $exception->errors());
        } else {
            return $this->apiResponse();
        }
    }

    public function apiResponse($message = 'Something went wrong! Please try again.', $code = 400, $data = [])
    {
        $response = [
            'message' => $message,
            'type' => 'error',
            'code' => $code
        ];

        if (!!$data)
            $response['errors'] = $data;

        return response()->json($response, $code);
    }
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
