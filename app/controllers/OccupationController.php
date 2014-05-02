<?php

use Informulate\Occupation\Creator;
use \Informulate\Transformers\OccupationsTransformer;

class OccupationController extends ApiController {

	/**
	 * @var Informulate\Transformers\OccupationsTransformer
	 */
	protected $occupationTransformer;

	/**
	 * @param OccupationsTransformer $occupationTransformer
	 */
	function __construct(OccupationsTransformer $occupationTransformer)
	{
		$this->occupationTransformer = $occupationTransformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /occupation
	 *
	 * @return Response
	 */
	public function index()
	{
		$occupations = Occupation::paginate($this->getLimit());

		return $this->respondWithPagination($occupations, [
			'data' => $this->occupationTransformer->transformCollection($occupations->all()),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /occupations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = [
			'form' => [
				'string' => 'name'
			],
			'action' => URL::route('api.v1.occupations.store'),
			'method' => 'POST'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /occupation
	 *
	 * @return Response
	 */
	public function store()
	{
		$creator = new Creator($this);

		return $creator->create(Input::all());
	}

	/**
	 * @param $errors
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function occupationCreationFails($errors)
	{
		return $this->respondWithError($errors);
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function occupationCreationSucceeds()
	{
		return $this->respond(['data' => ['success' => true]]);
	}

	/**
	 * Display the specified resource.
	 * GET /occupation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$occupation = Occupation::findByIdOrSlug($id);

		if ($occupation) {
			return $this->respond($this->occupationTransformer->transform($occupation));
		}

		return $this->respondNotFound();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /occupations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$occupation = Occupation::findByIdOrSlug($id);

		if (! $occupation) {
			return $this->respondNotFound();
		}

		$data = [
			'form' => [
				'name' => $occupation->name
			],
			'action' => URL::route('api.v1.occupations.update', ['occupation' => $id]),
			'method' => 'PUT'
		];

		return $this->respond(['data' => $data]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /occupation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /occupations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
