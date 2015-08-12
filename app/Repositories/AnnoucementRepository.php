<?php

namespace App\Repositories;

use App\Models\Announcement;

class AnnouncementRepository
{
	/**
	 * Saves the Announcement
	 *
	 * @param Announcement $announcement
	 * @return bool
	 */
	public function save(Announcement $announcement)
	{
		return $announcement->save();
	}

}
