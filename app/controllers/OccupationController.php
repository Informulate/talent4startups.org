<?php

use \Informulate\Transformers\OccupationsTransformer;

class OccupationController extends ApiController {

	/**
	 * @var Informulate\Transformers\OccupationsTransformer
	 */
	protected $occupationTransformer;

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
		$limit = Input::get('limit', 10);
		$limit = $limit > 100 ? 10 : $limit; // limits the per page to 100.

		$occupations = Occupation::paginate($limit);

		return $this->respondWithPagination($occupations, [
			'data' => $this->occupationTransformer->transformCollection($occupations->all()),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /occupation/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /occupation
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
			return $this->occupationTransformer->transform($occupation);
		}

		return $this->respondNotFound();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /occupation/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
	 * DELETE /occupation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
