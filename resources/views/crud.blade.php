<!DOCTYPE html>
<html lang="en">
<head>
  <title>APA -Sample CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<div class="container">
  <h2>APA - Sample CRUD</h2>

  @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Emp ID</th>
        <th>Emp Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>DOB</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($employees as $emp)
      <tr>
        <td>{{$emp->id}}</td>
        <td>{{$emp->name}}</td>
        <td>{{$emp->email}}</td>
        <td>{{$emp->phone}}</td>
        <td>{{$emp->dob}}</td>
        <td>
            <a data-target="#editModal" data-id="{{$emp->id}}" data-name="{{$emp->name}}" data-email="{{$emp->email}}" data-phone="{{$emp->phone}}" data-dob="{{$emp->dob}}" data-toggle="modal" href="#editModal" class="editModal">Edit</a> /
            {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy', $emp->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'delete', 'onclick' => "return confirm('Are you sure you want to delete the employee?')"]) !!}
            {!! Form::close() !!}
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" align="middle">No employees found</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="add-btn">
    <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#addModal">Add</button>
  </div>

    <!-- Employee Add Modal -->
    <div class="modal fade" id="addModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Employee</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label  class="col-sm-2 control-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="phone">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" minlength="10" maxlength="10" id="phone" name="phone" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="datepicker">DOB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="datepicker" name="dob" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>        
        </div>
    </div>

    <!-- Employee Edit Modal -->
    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.update', 1) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id"/>
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="phone">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" minlength="10" maxlength="10" id="phone" name="phone" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="dob">DOB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="dob" name="dob" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>        
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).on("click", ".editModal", function () {
    $("#editModal .modal-body #id").val( $(this).data('id') );
    $("#editModal .modal-body #name").val( $(this).data('name') );
    $("#editModal .modal-body #email").val( $(this).data('email') );
    $("#editModal .modal-body #phone").val( $(this).data('phone') );
    $("#editModal .modal-body #dob").val( $(this).data('dob') );

    $( "#dob" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
});

$( document ).ready(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
});

</script>
</body>
</html>
