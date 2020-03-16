
@extends('layouts.master')

@section('title')
    Jobs Available
@endsection

@section('main')
<div class="container">
    
    <table class="table table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>Job Title</th>
              <th>Ref No</th>
              <th>Job Location</th>
              <th>Job Description</th>
              <th>Number of Posts</th>
             
              <th></th>
            </tr>
          </thead>
          @foreach ($jobs as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->jobtitle}}</td>
            <td>{{$item->refno}}</td>
            <td>{{$item->joblocation}}</td>
            
            <td>{{$item->jobdescription}}</td>
            <td>{{$item->numberofposts}}</td>
            <td><a href="/showshop/{{$item->id}}">Read More</a></td>
        </tr>
        @endforeach
    </table>
    
    
 
      

  </div>
 
@endsection

