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
	
	// //get list of all skills from applicants for this job.
	// public function skills()
	// {
		// return $this->hasManyThrough('App\Skill', 'App\Applicant');//->select('skills.name');
	// }
	
	// // //get skills count from all applicants for this job.
	// public function skills_count()
	// {
		// return $this->hasManyThrough('App\Skill', 'App\Applicant')->count();//->select('skills.name');
	// }

	// //get distinct skills
	// public function unique_skills()
	// {
		// return $this->hasManyThrough('App\Skill', 'App\Applicant')->select('skills.name')->distinct('skills.name');
	// }
	
	//Get job name rowspan for view.  Return rowspan value of 1 or greater.
	public function job_name_rowspan()
	{
		$job_name_rowspan = 0;
		foreach ($this->applicants as $applicant)
		{	
				$job_name_rowspan = $job_name_rowspan + (($applicant->skills()->count()>0) ? $applicant->skills()->count() : 1);
		}
		
		return ($job_name_rowspan > 0) ? $job_name_rowspan : 1;
	}

}
