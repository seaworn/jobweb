@extends('admin.master')
@section('navbar')
    
@endsection
@section('workingarea')
<div class="row" >
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Jobs</div>
                <form  action="{{ url('updatejob/'.$jobs->id)}}" method="POST" >
    
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                   
                    
            <div class="modal-body">
                    
                        <div class="form-group">
                        <label >Vacancy Title</label>
                        <input type="text" name="jobtitle"  value="{{$jobs->jobtitle}}" class="form-control">
                        </div>
                        <div class="form-group">
                        <label >Refference Number</label>
                        <input type="text" name="refno" value="{{$jobs->refno}}" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label >Location</label>
                        <input type="text" name="joblocation"value="{{$jobs->joblocation}}" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label >Job Description</label>
                            <input type="text" name="jobdescription"value="{{$jobs->jobdescription}}" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label >Experience Level</label>
                        <input type="text" name="experiencelevel"value="{{$jobs->experiencelevel}}" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label >Skill Required</label>
                        <input type="text" name="skillrequired" value="{{$jobs->skillrequired}}" class="form-control" >
                        </div>
                        <div class="form-group">
                        <label >Duties</label>
                        <input type="text" name="duties" value="{{$jobs->duties}}" class="form-control">
                        </div>
                        <div class="form-group">
                        <label >Salary Range</label>
                        <select class="form-control" name="salaryrange" value="{{$jobs->salaryrange}}">
                            <option value="Ksh.10,000 - Ksh.20,000">Ksh.10,000 - Ksh.20,000</option>
                            <option value="Ksh.20,000 - Ksh.30,000">Ksh.20,000 - Ksh.30,000</option>
                            <option value="Ksh.30,000 - Ksh.40,000">Ksh.30,000 - Ksh.40,000</option>
                            <option value="Ksh.40,000 - Ksh.50,000">Ksh.40,000 - Ksh.50,000</option>
                            <option value="Ksh.50,000 - Ksh.60,000">Ksh.50,000 - Ksh.60,000</option>
                            </select>
                        
                        </div> 
                        <div class="form-group">
                        <label >Number of Posts</label>
                        <input type="text" name="numberofposts" class="form-control" value="{{$jobs->numberofposts}}">
                        </div>                             
                        <div class="form-group">
                        <label >Date Line</label>
                        <input type="text" name="deadline" class="form-control" value="{{$jobs->deadline}}">
                        </div> 

        <!-- Modal footer of Add New Role -->
                        <div class="modal-footer">
                            
                            <a type="button" href="{{ url('/posted-jobs')}}" class="btn btn-danger">Back</a>
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                </form>
                    

            </div>
        </div>
    </div>

</div>



    
@endsection
@section('navbar')
    
@endsection