
@extends('layouts.master')

@section('title')
    Jobs Available
@endsection

@section('main')

<div class="card">
    <div class="card-header">
      Vacany::{{ $job->jobtitle  }} | Refference No::{{ $job->refno   }}
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ $job->jobdescription   }}</h5>
      <p class="card-text">The Opportunity has the following roles<br>{{ $job->duties  }}</p>
      <p class="card-text">successful candidate will be stationed at <br>{{ $job->joblocation   }}</p>
      <p class="card-text">Skills Required {{ $job->skillrequired   }}</p>
      <p class="card-text">The candidate should have Experience of <br>{{ $job->experiencelevel    }}</p>
      <p class="card-text">What we require of the successful candidate{{ $job->duties }}</p>
      <p class="card-text">Range of Salary<br>{{ $job->salaryrange  }}</p>
      <p class="card-text">Job posted on<br>{{ $job->created_at   }}</p>
      <p class="card-text">Apply on or Before<br>{{ $job->deadline   }}</p>
      


      <a href="/applyjob/{{ $job->id  }}" class="btn btn-primary">Apply</a>
    </div>
  </div>



@endsection

