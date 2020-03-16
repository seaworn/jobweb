@extends('admin.master')
@section('navbar')

@endsection
@section('workingarea')
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
    
    </div>
    </div>
    </div>
        <h3>Jobs Table</h3>
        
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Add New Jobs
        </button>
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="dataTable">
          <thead>
          <tr>
          <th>Job Title</th>
          <th>Reference Number</th>
          <th>Location</th>
          <th>Number of Posts</th>
          <th>Deadline</th>
          <th>Date Created</th>
          
          <th colspan="2">Action</th>
          <th><a href="/exportJobs" class="btn btn-primary">Export To PDF</a></th>
          </tr>
          </thead>

          <tbody>
              @foreach ($jobs  as $item)   
              
              <tr>
             <td>{{ $item->jobtitle}}</td>
                  <td>{{ $item->refno}}</td>
                  <td>{{ $item->joblocation}}</td>
                  <td>{{ $item->numberofposts}}</td>
                  <td>{{ $item->deadline}}</td>
                  <td>{{ $item->created_at}}</td>
                  <td><a href="/posted-jobs" class="btn btn-info">Applicants <span class="badge badge-secondary">12</a></td>
                  <td >
                      <a href="{{ url('/editpostedjobs/'.$item->id)}}" class="btn btn-info">Update</a>
                  </td> 

                  <td >
                      <form method="POST" action="{{ url('deletepostedjob/'.$item->id) }}">

                          {{ csrf_field() }}

                          {{ method_field('DELETE') }}

                          <button type="submit" class="btn btn-danger">Delete</button>

                        </form>
                  </td>
                  
                  
              </tr>
              @endforeach

          </tbody>
          </table>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Jobs</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body of Add New Role -->
      <form action="/savejobs" method="POST">

        {{ csrf_field() }}


        <div class="modal-body">

          <div class="form-group">
            <label>Vacancy Title</label>
            <input type="text" name="jobtitle" class="form-control">
          </div>

          <div class="form-group">
            <label>Refference Number</label>
            <input type="text" name="refno" class="form-control">
          </div>

          <div class="form-group">
            <label>Location</label>
            <input type="text" name="joblocation" class="form-control">
          </div>

          <div class="form-group">
            <label>Job Description</label>
            <input type="text" name="jobdescription" class="form-control">
          </div>

          <div class="form-group">
            <label>Experience Level</label>

            <select class="form-control" name="experiencelevel">
              <option value="Less than 1 Year">Less than 1 Year</option>
              <option value="2 Years">2 Years</option>
              <option value="3 Years">3 Years</option>
              <option value="4 Years">4 Years</option>
              <option value="Over 5 Years">Over 5 Years</option>
            </select>
          </div>
          <div class="form-group">
            <label>Skill Required</label>

            <select class="form-control" name="skillrequired">
              <option value="No Skills">No Skills</option>
              <option value="Web Design">Web Design</option>
              <option value="Database Design">Database Design</option>
              <option value="System Administration">System Administration</option>
              <option value="Data Science">Data Science</option>
            </select>
          </div>
          <div class="form-group">
            <label>Duties</label>
            <input type="text" name="duties" class="form-control">
          </div>
          <div class="form-group">
            <label>Salary Range</label>
            <select class="form-control" name="salaryrange">
              <option value="Ksh.10,000 - Ksh.20,000">Ksh.10,000 - Ksh.20,000</option>
              <option value="Ksh.20,000 - Ksh.30,000">Ksh.20,000 - Ksh.30,000</option>
              <option value="Ksh.30,000 - Ksh.40,000">Ksh.30,000 - Ksh.40,000</option>
              <option value="Ksh.40,000 - Ksh.50,000">Ksh.40,000 - Ksh.50,000</option>
              <option value="Ksh.50,000 - Ksh.60,000">Ksh.50,000 - Ksh.60,000</option>
            </select>

          </div>
          <div class="form-group">
            <label>Number of Posts</label>
            <select class="form-control" name="numberofposts">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
            </select>
          </div>
          <div class="form-group">
            <label>Deadline</label>
            <input type="text" name="deadline" class="form-control">
          </div>

          <!-- Modal footer of Add New Role -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

      </form>

    </div>

  </div>
</div>
</div>
<h3>Jobs Table</h3>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add New Jobs
</button>
<div class="table-responsive">
  <table class="table table-striped table-sm" id="dataTable">
    <thead>
      <tr>
        <th>Job Title</th>
        <th>Reference Number</th>
        <th>Location</th>
        <th>Number of Posts</th>
        <th>Deadline</th>
        <th>Date Created</th>
        <th></th>
        <th colspan="2">Action</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($jobs as $item)

      <tr>
        <td>{{ $item->jobtitle}}</td>
        <td>{{ $item->refno}}</td>
        <td>{{ $item->joblocation}}</td>
        <td>{{ $item->numberofposts}}</td>
        <td>{{ $item->deadline}}</td>
        <td>{{ $item->created_at}}</td>
        <td><a href="" class="btn btn-info">Applicants <span class="badge badge-secondary">12</a></td>
        <td>
          <a href="{{ url('/editpostedjobs/'.$item->id)}}" class="btn btn-info">Update</a>
        </td>

        <td>
          <form method="POST" action="{{ url('deletepostedjob/'.$item->id) }}">

            {{ csrf_field() }}

            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger">Delete</button>

          </form>
        </td>


      </tr>
      @endforeach

    </tbody>
  </table>
</div>
@endsection

@section('scripts')

@endsection