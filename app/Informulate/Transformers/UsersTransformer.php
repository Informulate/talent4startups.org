<?php

namespace Informulate\Transformers;

class UsersTransformer extends Transformer {

	/**
	 * @param $user
	 * @return array
	 */
	public function transform($user)
	{
		return [
			'username' => $user['username'],
			'email' => $user['email'],
			'created_at' => $user['created_at'],
			'updated_at' => $user['updated_at']
		];
	}

}
