<!DOCTYPE html>
<html>
  <head>
    <title>Job Applicants Report</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssbase/cssbase-min.css">
    <style type="text/css">
      #page {
        width: 1200px;
        margin: 30px auto;
      }
      .job-applicants {
        width: 100%;
      }
      .job-name {
        text-align: center;
      }
      .applicant-name {
        width: 150px;
      }
    </style>
  </head>
  <body>
    <div id="page">
      <table class="job-applicants">
        <thead>
          <tr>
            <th>Job</th>
            <th>Applicant Name</th>
            <th>Email Address</th>
            <th>Website</th>
            <th>Skills</th>
            <th>Cover Letter Paragraph</th>
          </tr>
        </thead>
		
	    <tbody>
@if(count($jobs) > 0){{-- there jobs to display --}}
@foreach($jobs as $job){{-- start of foreach jobs loop --}}
		  <!-- {{ $job->name }} -->
		  <tr>
		    <td rowspan="{{ $job->job_name_rowspan() }}" class="job-name">{{ $job->name }}</td>
@if(count($job->applicants) > 0)
@foreach($job->applicants as $applicant)
@if(!($loop->first))
		  <tr>
@endif
			<td rowspan="{{ $applicant->applicant_rowspan() }}" class="applicant-name">{{ $applicant->name }}</td>
            <td rowspan="{{ $applicant->applicant_rowspan() }}"><a href="mailto:{{ $applicant->email }}">{{ $applicant->email }}</a></td>
			<td rowspan="{{ $applicant->applicant_rowspan() }}"><a href="{{ $applicant->website }}">{{ $applicant->formatted_website() }}</td>
            <td>{{ (count($applicant->skills)>0) ? $applicant->skills[0]->name : ''}}</td>
            <td rowspan="{{ $applicant->applicant_rowspan() }}">{{ $applicant->cover_letter }}</td>
          </tr>
@for($z = 1; $z < count($applicant->skills); $z++)
		  <tr>
			<td>{{ $applicant->skills[$z]->name }}</td>
		  </tr>
@endfor
@endforeach
@else{{-- no applicants for this job --}}
			<td colspan="5">No Applicants</td>
		  </tr>
@endif
		  <!-- {{ $job->name }} -->	

@endforeach{{-- end of foreach jobs loop --}}
@else {{-- no jobs to display --}}
		  <tr>
			<td colspan="6">No Jobs</td>
		  </tr>	
@endif
        </tbody>
		
        <tfooter>
          <tr>
            <td colspan="6">{{ $applicant_count }} Applicants, {{ $unique_skills_count }} Unique Skills</td>
          </tr>
        </tfooter>
      </table>
    </div>
  </body>
</html>

