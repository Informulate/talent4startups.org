<?php

use Informulate\Transformers\UserOccupationsTransformer;

class UserOccupationsController extends ApiController
{
	/**
	 * @var Informulate\Transformers\OccupationsTransformer
	 */
	protected $userOccupationTransformer;

	/**
	 * @param UserOccupationsTransformer $userOccupationTransformer
	 */
	function __construct(UserOccupationsTransformer $userOccupationTransformer)
	{
		$this->userOccupationTransformer = $userOccupationTransformer;
	}

	/**
	 * Display a listing of the resource.
	 * GET /user/{username or id}/tags
	 *
	 * @param $user
	 * @return Response
	 */
	public function index($user)
	{
		$user = User::findByIdOrUsername($user);

		if (! $user) {
			return $this->respondNotFound();
		}

		return $this->respond($this->userOccupationTransformer->transformCollection($user->occupations->toArray()));
	}

	/**
	 * @param $user
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function experience($user)
	{
		$user = User::findByIdOrUsername($user);

		if (! $user) {
			return $this->respondNotFound();
		}

		$experience = $user->occupations->filter(function($occupation) {
			return false == $occupation->pivot->interest;
		});

		return $this->respond($this->userOccupationTransformer->transformCollection($experience->toArray()));
	}

	/**
	 * @param $user
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
	public function interest($user)
	{
		$user = User::findByIdOrUsername($user);

		if (! $user) {
			return $this->respondNotFound();
		}

		$interests = $user->occupations->filter(function($occupation) {
			return $occupation->pivot->interest;
		});

		return $this->respond($this->userOccupationTransformer->transformCollection($interests->toArray()));
	}

}
