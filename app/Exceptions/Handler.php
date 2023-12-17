<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

        $this->renderable(function (Throwable $e, Request $request) {
            // APIで発生したエラーを処理
            if ($request->is('api/*') || $request->ajax())
            {
                if ($this->isHttpException($e))
                {
                    // 返却するメッセージを設定
                    $message = $e->getMessage() ?: Response::$statusTexts[$e->getStatusCode()];
					return response()->json(['message' => $message], $e->getStatusCode());
                }
                elseif ($e instanceof ValidationException)
				{
                    // バリデーションエラー発生時のレスポンスを処理
                    $errors = [];
                    foreach ($e->validator->errors()->getMessages() as $key => $value) {
                        $errors[] = [
                            'attribute' => $key,
                            'message' => $value[0]
                        ];
                    }
					return response()->json(['errors' => $errors], $e->status);
				}
                else
                {
                    return response()->json(['message' => 'Internal Server Error'], 500);
                }
            }
        });
    }
}
