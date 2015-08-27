<?php namespace App\Exceptions;

use Exception, Slack;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException',
		'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
		'Illuminate\Database\Eloquent\ModelNotFoundException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		if (strtolower(getenv('SLACK_ENABLE')) === 'true' and false === in_array(get_class($e), $this->dontReport)) {
			Slack::send("*Exception:* " . get_class($e) . "\n*File:* {$e->getFile()}\n*Line:* {$e->getLine()}\n*Message:* {$e->getMessage()}");
		}

		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		return parent::render($request, $e);
	}

}
