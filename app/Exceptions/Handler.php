<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // https://gist.github.com/jrmadsen67/bd0f9ad0ef1ed6bb594e
        if ($exception instanceof TokenMismatchException)
        {
            $errors = new MessageBag([
                'password' => 'For security purposes, the form expired after sitting idle for too long. Please try again.'
            ]);

            return redirect()->back()
                ->withInput($request->except($this->dontFlash))
                ->with(['errors' => $errors]);
        }

        return parent::render($request, $exception);
    }
}
