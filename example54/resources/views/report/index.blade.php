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
@foreach($jobs as $job)
		  <!-- {{ $job->name }} -->
		  <tr>
            <td rowspan="{{ $job->skill_count }}" class="job-name">{{ $job->name }}</td>@foreach($job->applicants as $applicant)
@if(!($loop->first))
		  <tr>@endif		  
			<td rowspan="{{ sizeof($applicant->skills) }}" class="applicant-name">{{ $applicant->name }}</td>
            <td rowspan="{{ sizeof($applicant->skills) }}"><a href="mailto:{{ $applicant->email }}">{{ $applicant->email }}</a></td>
            <td rowspan="{{ sizeof($applicant->skills) }}"><a href="{{ $applicant->website }}">{{ preg_replace('/.*\/\/(.*)/', '$1', $applicant->website) }}</td>
            <td>{{ $applicant->skills[0]->name }}</td>
            <td rowspan="{{ sizeof($applicant->skills) }}">{{ $applicant->cover_letter }}</td>
          </tr>
@for($z = 1; $z<sizeof($applicant->skills); $z++)
			<tr>
			  <td>{{ $applicant->skills[$z]->name }}</td>
			</tr>
@endfor
@endforeach		  <!-- {{ $job->name }} -->
			
@endforeach
		
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

