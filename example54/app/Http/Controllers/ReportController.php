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
    // //use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	// public function __contruct()
	// {		
			// parent::__contruct();
	// }
	
	
	public function index()
	{
		$applicant_count = 0;
		$unique_skills_count = 0;
		$arr_skills = array();
		
		$jobs = Job::all();
		//build the page data

		// $applicants 		= Applicant::get(['id', 'name']);
		// $unique_skills 	= Skill::distinct()->get(['name']);
		// $applicant_count 	 = sizeof($applicants);
		// $unique_skills_count  = sizeof($unique_skills);
		
		//-----
		//calculate skill_count for the job name row span td
		//build $applicant_count
		//build $arr_skills for calculating unique skills count.
		foreach ($jobs as $key=>$value)
		{
			$jobs[$key]['skill_count'] = 0;
			$applicant_count = $applicant_count + sizeof($jobs[$key]->applicants);
			
			foreach ($jobs[$key]->applicants as $applicant)
			{
				$jobs[$key]['skill_count'] = $jobs[$key]['skill_count'] + sizeof($applicant->skills);				
				foreach ($applicant->skills as $skill) 
				{
					//$arr_skills[] = $skill->name;
					$arr_skills[$skill->name] = true;
				}				
			}
		}		
		//$unique_skills_count = sizeof(array_unique($arr_skills));
		$unique_skills_count = sizeof($arr_skills);
		//-----
			
	
		//data for view
		// $data['jobs'] = $jobs;		
		// $data['applicant_count']     = $applicant_count;
		// $data['unique_skills_count'] = $unique_skills_count;		
		// return view('report/show', ['data' => $data] );
		
		return view('report/index', [
			'jobs' => $jobs,
			'applicant_count' => $applicant_count,
			'unique_skills_count' => $unique_skills_count			
			] );
		
	}
}
