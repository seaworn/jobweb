
@extends('layouts.master')

@section('title')
    Jobs Available
@endsection

@section('main')

<div class="container">
    <div class="alert alert-primary" role="alert">
        Application Form
        
      </div>
      <h4>{{ $job->jobtitle  }}</h4>
    <form method="post" enctype="multipart/form-data" action="{{route('applyjob', ['job'=>$job->id])}}">
      @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Cover Letter</label>
            <textarea class="form-control" name='cover_letter' rows="3"></textarea>
          </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Attach Your Updated C.V</label>
          <input type="file" class="form-control-file" name='cv'>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
</div>




@endsection

