<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Custom Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Student Database</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card shadow p-5">
            <div class="card-header">
                <h2 class="text-center pt-3">
                  {{ __('All Student List') }}
                  <a href="#" id="click_add_student" class="btn btn-primary float-right" style="padding-top: 10px; padding-bottom: 0px;">
                    Add New Student
                  </a>
                </h2>
                </div>
                <div class="card-body">
                  {{-- All Students' Information Starts --}}
                    <table class="table table-hovered">
                      <thead>
                        <tr>
                          <th class="py-3">#</th>
                          <th class="py-3">Name</th>
                          <th class="py-3">Email</th>
                          <th class="py-3">Cell</th>
                          <th class="py-3">Gender</th>
                          <th class="py-3">Donation</th>
                          <th class="py-3">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($students as $student)
                        <tr>
                          <td class="py-3">{{ $student->id }}</td>
                          <td class="py-3">{{ $student->name }}</td>
                          <td class="py-3">{{ $student->email }}</td>
                          <td class="py-3">{{ $student->cell }}</td>
                          <td class="py-3">{{ $student->gender }}</td>
                          <td class="py-3">{{ $student->monthly_donation }}</td>
                          <td class="py-3">
                            <div class="btn-group" role="group">
                              <button type="button" student-id="{{ $student->id }}" id="click_edit_student" class="btn btn-info btn-sm">View</button>
                              <button type="button" student-id="{{ $student->id }}" id="click_edit_student" class="btn btn-danger btn-sm">Delete</button>
                              <button type="button" student-id="{{ $student->id }}" id="click_edit_student" class="btn btn-success btn-sm">Edit</button>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="7" class="text-center text-info">
                            <h5 class="py-3"> No Students' Information has been Registered Yet</h5>
                          </td>
                        </tr>
                      @endforelse
                      </tbody>
                    </table>
                    {{-- All Students' Information Ends --}}
                </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal for Adding a Student's Information Starts --}}
    <div id="add_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body pt-3 pb-4 px-5">
            <h3 class="text-center py-3">Student Registration</h3>
            <form method="post">
              @csrf
              <div class="form-group">
                <label for="add_modal_student_name">Name</label>
                <input class="form-control" type="text" id="add_modal_student_name" name="name" value="{{ old('name') }}">
              </div>
              <div class="form-group">
                <label for="add_modal_student_email">Email</label>
                <input class="form-control" type="text" id="add_modal_student_email" name="email" value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <label for="add_modal_student_cell">Cell</label>
                <input class="form-control" type="text" id="add_modal_student_cell" name="cell" value="{{ old('cell') }}">
              </div>
              <div class="form-group">
                <label for="add_modal_student_gender">Gender</label>
                <input class="form-control" type="text" id="add_modal_student_gender" name="gender" value="{{ old('gender') }}">
              </div>
              <div class="form-group">
                <label for="add_modal_student_monthly_donation">Donation</label>
                <input class="form-control" type="number" id="add_modal_student_monthly_donation" name="monthly_donation" value="{{ old('monthly_donation') }}">
              </div>
              <div class="form-group">
                <input class="form-control btn btn-primary" type="submit" value="ADD" style="padding-top: 10px; padding-bottom: 0px;"></input>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal for Adding a Student's Informationent Ends --}}

    {{-- Modal for Editing a Student's Information Starts --}}
    <div id="edit_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body pt-3 pb-4 px-5">
            <h3 class="text-center py-3">Update a Student's Information</h3>
            <form method="post">
              @csrf
              <div class="form-group">
                <label for="add_modal_student_name">Name</label>
                <input class="form-control" type="text" id="edit_modal_student_name" name="name">
              </div>
              <div class="form-group">
                <label for="add_modal_student_email">Email</label>
                <input class="form-control" type="text" id="edit_modal_student_email" name="email">
              </div>
              <div class="form-group">
                <label for="add_modal_student_cell">Cell</label>
                <input class="form-control" type="text" id="edit_modal_student_cell" name="cell">
              </div>
              <div class="form-group">
                <label for="add_modal_student_gender">Gender</label>
                <input class="form-control" type="text" id="edit_modal_student_gender" name="gender">
              </div>
              <div class="form-group">
                <label for="add_modal_student_monthly_donation">Donation</label>
                <input class="form-control" type="number" id="edit_modal_student_monthly_donation" name="monthly_donation">
              </div>
              <div class="form-group">
                <input class="form-control btn btn-success" type="submit" value="Save Changes" style="padding-top: 10px; padding-bottom: 0px;"></input>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal for Editing a Student's Information Ends --}}

    {{-- Modal for Viewing a Student's Information Starts --}}
    <div id="view_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h3 class="text-center py-3">Student's Information</h3>
            <table class="table table-hovered">
              <tr>
                <th>ID</th>
                <td>20</td>
              </tr>
              <tr>
                <th>Name</th>
                <td>Kan Helal</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>helal.kan@gmail.com</td>
              </tr>
              <tr>
                <th>Cell</th>
                <td>01715263654</td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>Male</td>
              </tr>
              <tr>
                <th>Donation</th>
                <td>150 tk</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal for Viewing a Student's Information Ends --}}



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}">

    </script>
  </body>
</html>
