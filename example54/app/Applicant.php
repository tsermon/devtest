<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Notes:
	// Relationships:
	// has one job
	// has many skills

class Applicant extends Model
{
	protected $table = "applicants";

	
	public function job()
	{
		return $this->hasOne('App\Job');
	}

	public function skills()
	{
		return $this->hasMany('App\Skill');
	}	
	
}
