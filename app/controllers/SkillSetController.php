<?php

use Informulate\SkillSet\Creator;
use \Informulate\Transformers\SkillSetsTransformer;

class SkillSetController extends ApiController {

	/**
	 * @var Informulate\Transformers\SkillSetsTransformer
	 */
	protected $skillSetTransformer;

	/**
	 * @param SkillSetsTransformer $skillSetTransformer
	 */
	function __construct(SkillSetsTransformer $skillSetTransformer)
	{
		$this->skillSetTransformer = $skillSetTransformer;
	}


	/**
	 * Display a listing of the resource.
	 * GET /occupation
	 *
	 * @param $username
	 * @return Response
	 */
	public function index($username)
	{
		$user = User::where('username', $username)->firstOrFail();
		$skills = $user->skillSets()->paginate($this->getLimit());

		return $this->respondWithPagination($skills, [
			'data' => $this->skillSetTransformer->transformCollection($skills->all()),
		]);
	}

	/**
	 * @param $username
	 * @return mixed
	 */
	public function experience($username)
	{
		$user = User::where('username', $username)->firstOrFail();
		$skills = $user->skillSets()->where('interest', false)->paginate($this->getLimit());

		return $this->respondWithPagination($skills, [
			'data' => $this->skillSetTransformer->transformCollection($skills->all()),
		]);
	}

	/**
	 * @param $username
	 * @return mixed
	 */
	public function interest($username)
	{
		$user = User::where('username', $username)->firstOrFail();
		$skills = $user->skillSets()->where('interest', true)->paginate($this->getLimit());

		return $this->respondWithPagination($skills, [
			'data' => $this->skillSetTransformer->transformCollection($skills->all()),
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
	public function skillSetCreationFails($errors)
	{
		return $this->respondWithError($errors);
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function skillSetCreationSucceeds()
	{
		return $this->respond(['data' => ['success' => true]]);
	}

	/**
	 * Display the specified resource.
	 * GET /occupation/{id}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$skillset = SkillSet::where('slug', $slug)->firstOrFail();

		if ($skillset) {
			return $this->respond($this->skillSetTransformer->transform($skillset));
		}

		return $this->respondNotFound();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /occupations/{id}/edit
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function edit($slug)
	{
		$skillset = SkillSet::where('slug', $slug)->firstOrFail();

		if (! $skillset) {
			return $this->respondNotFound();
		}

		$data = [
			'form' => [
				'name' => $skillset->name
			],
			'action' => URL::route('api.v1.skillsets.update', ['skillset' => $slug]),
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
