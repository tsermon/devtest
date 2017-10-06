<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $table = "jobs";

	
	//a job can have many applicants.  one to many/none.
	public function applicants()
	{
		return $this->hasMany('App\Applicant');
		
	}
	
	
}
