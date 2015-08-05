<?php

namespace App\Repositories;


use App\Models\Match;

class MatchRepository
{
	public static function getMatches($user_id, $limit = 3, $since = '-4 weeks')
	{
		$since = new \DateTime($since);
		$matches = Match::where('ignored', '=', false)
			->where('user_id', '=', $user_id)
			->where('updated_at', '>=', $since)
			->orderBy('weight', 'DESC')
			->limit($limit);

		return $matches->get();
	}
}
