<?php

use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class ApiController extends BaseController {

	/**
	 * @var int
	 */
	protected $statusCode = ResponseCodes::HTTP_OK;
	protected $limit = 10;

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 * @return $this
	 */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getLimit()
	{
		$this->limit = Input::get('limit', 10);
		$this->limit = $this->limit > 100 ? 10 : $this->limit; // limits the per page to 100.

		return $this->limit;
	}

	/**
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'Not found!')
	{
		return $this->setStatusCode(ResponseCodes::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * @param $message
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
	}

	/**
	 * @param $data
	 * @param array $headers
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * @param Paginator $objects
	 * @param $data
	 * @return mixed
	 */
	public function respondWithPagination(Paginator $objects, $data)
	{
		$data = array_merge($data, [
			'paginator' => [
				'total_count'   => $objects->getTotal(),
				'total_pages'   => ceil($objects->getTotal() / $objects->getPerPage()),
				'current_page'  => $objects->getCurrentPage(),
				'limit'         => $objects->getPerPage()
			]
		]);

		return $this->respond($data);
	}

	/**
	 * @param $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondCreated($data)
	{
		return $this->setStatusCode(ResponseCodes::HTTP_CREATED)->respond(['data' => $data]);
	}

}
