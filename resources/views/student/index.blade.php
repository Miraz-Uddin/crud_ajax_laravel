<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <h2 class="text-center">
                  {{ __('All Student List') }}
                  <a href="javascript:void(0)" id="click_add_student" class="btn btn-primary float-right">
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
                          <th class="py-3">Donation (৳)</th>
                          <th class="py-3">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="all_students_information"></tbody>
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
          <div class="card px-2 py-3">
              <div class="card-body">
                <h3 class="text-center">NEW Student's Information</h3>
                <div class="mt-4">
                  <div id="add_modal_message"></div>
                  <form id="add_modal_form">
                    @csrf
                    <div class="form-group">
                      <label for="add_modal_student_name">Name</label>
                      <input class="form-control" type="text" id="add_modal_student_name" name="name" value="{{ old('name') }}">
                      <small id="errorForCreatingName" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="add_modal_student_email">Email</label>
                      <input class="form-control" type="text" id="add_modal_student_email" name="email" value="{{ old('email') }}">
                      <small id="errorForCreatingEmail" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="add_modal_student_cell">Mobile No.</label>
                      <input class="form-control" type="text" id="add_modal_student_cell" name="cell" value="{{ old('cell') }}">
                      <small id="errorForCreatingCell" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="add_modal_student_gender">Gender</label>
                        <div class="input-group">
                          <select class="custom-select" type="text" id="add_modal_student_gender" name="gender" value="{{ old('gender') }}">
                            <option value="" selected>Choose...</option>
                            <option value="0">MALE</option>
                            <option value="1">FEMALE</option>
                          </select>
                        </div>
                        <small id="errorForCreatingGender" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <label for="add_modal_student_monthly_donation">Donation</label>
                      <div class="input-group">
                        <input class="form-control" type="number" id="add_modal_student_monthly_donation" name="monthly_donation" value="{{ old('monthly_donation') }}">
                        <div class="input-group-append">
                          <span class="input-group-text">৳</span>
                        </div>
                      </div>
                        <small id="errorForCreatingMonthlyDonation" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                      <input class="form-control btn btn-primary" type="submit" value="ADD"></input>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Modal for Adding a Student's Informationent Ends --}}

    {{-- Modal for Editing a Student's Information Starts --}}
    <div id="edit_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="card px-2 py-3">
            <div class="card-body">
              <h3 class="text-center">Update Student's Information</h3>
              <div class="mt-4">
                <div id="edit_modal_message"></div>
                <form id="edit_modal_form">
                  @csrf
                  <input type="hidden" id="edit_modal_student_id" name="id">
                  <div class="form-group">
                    <label for="add_modal_student_name">Name</label>
                    <input class="form-control" type="text" id="edit_modal_student_name" name="name">
                    <small id="errorForUpdatingName" class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="add_modal_student_email">Email</label>
                    <input class="form-control" type="text" id="edit_modal_student_email" name="email">
                    <small id="errorForUpdatingEmail" class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="add_modal_student_cell">Cell</label>
                    <input class="form-control" type="text" id="edit_modal_student_cell" name="cell">
                    <small id="errorForUpdatingCell" class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="add_modal_student_gender">Gender</label>
                    <div class="input-group">
                      <select class="custom-select" type="text" id="edit_modal_student_gender" name="gender">
                        <option value="" selected>Choose...</option>
                        <option value="0">MALE</option>
                        <option value="1">FEMALE</option>
                      </select>
                    </div>
                    <small id="errorForUpdatingGender" class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="add_modal_student_monthly_donation">Donation</label>
                    <div class="input-group">
                      <input class="form-control" type="number" id="edit_modal_student_monthly_donation" name="monthly_donation">
                      <div class="input-group-append">
                        <span class="input-group-text">৳</span>
                      </div>
                    </div>
                    <small id="errorForUpdatingMonthlyDonation" class="text-danger"></small>
                  </div>
                  <div class="form-group">
                    <input class="form-control btn btn-success" type="submit" value="Save Changes"></input>
                  </div>
                </form>
              </div>
            </div>
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
            <h3 class="text-center">Student's Information</h3>
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

    {{-- jQuery first, then Popper.js, then Bootstrap JS --}}
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- Custom JavaScript --}}
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
