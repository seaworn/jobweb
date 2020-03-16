<table class="table table-striped">
    <thead class="thead-light">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Job Title</th>
        <th scope="col">Ref No.</th>
        <th scope="col">Job Location</th>
        <th scope="col">No Of Posts</th>
        <th scope="col">Deadline Of Application</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pdfdata as $pdfitem)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$pdfitem->jobtitle}}</td>
            <td>{{$pdfitem->refno}}</td>
            <td>{{$pdfitem->joblocation }}</td>
            <td>{{$pdfitem->numberofposts}}</td>
            <td>{{$pdfitem->created_at}}</td>
          </tr>
            
        @endforeach


    </tbody>
  </table>