<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Job;
use App\Applicant;
use App\Skill;

class ReportController extends Controller
{
	
	public function index()
	{		
		$applicant_count = 0;
		$unique_skills_count = 0;
		$arr_unique_skills = array();
		
		$jobs = Job::all();

		
		//-----
		//build $applicant_count
		//build $arr_unique_skills for calculating unique skills count.
		foreach ($jobs as $key=>$value)
		{
			$applicant_count = $applicant_count + sizeof($jobs[$key]->applicants);
			
			foreach ($jobs[$key]->applicants as $applicant)
			{	
				foreach ($applicant->skills as $skill) 
				{					
					$arr_unique_skills[$skill->name] = true;
				}				
			}

		}		
		//dd($arr_unique_skills);
		//var_dump($arr_unique_skills);
		$unique_skills_count = sizeof($arr_unique_skills);
		//-----
		//echo "applicant count:".$applicant_count."<br />";		
		//echo "unique_skills_count:".$unique_skills_count."<br />";		
		
		//data for view
		return view('report/index', [
			'jobs' => $jobs,
			'applicant_count' => $applicant_count,
			'unique_skills_count' => $unique_skills_count			
			] );
		
	}
}

  
  