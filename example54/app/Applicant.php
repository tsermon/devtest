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
	
	//Get applicant rowspan for view.  Return a value of 1 or greater
	public function applicant_rowspan()
	{
		return ((count($this->skills)>0) ? count($this->skills) : '1');
	}
	
	//Format website value for display
	public function formatted_website()
	{
		//<td rowspan="{{ $applicant->applicant_rowspan() }}"><a href="{{ $applicant->website }}">{{ preg_replace('/.*\/\/(.*)/', '$1', $applicant->website) }}</td>
		return preg_replace('/.*\/\/(.*)/', '$1', $this->website);
	}
	
}

