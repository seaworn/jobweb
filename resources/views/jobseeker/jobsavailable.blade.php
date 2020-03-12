
@extends('layouts.master')

@section('title')
    Jobs Available
@endsection

@section('main')
<div class="container">
    @foreach ($jobs as $item)
    <table>
        <tr>
            <td>{{$item->jobtitle}}Job Title</td>
            <td>{{$item->jobtitle}}Job Title</td>
            <td>{{$item->refno}}</td>
            <td>{{$item->joblocation}}</td>
            <td>{{$item->jobdescription}}</td>
            <td><a href="/showshop/{{$item->id}}">Read More</a></td>
        </tr>
    </table>
    
    
 
      

  </div>
  @endforeach
@endsection

