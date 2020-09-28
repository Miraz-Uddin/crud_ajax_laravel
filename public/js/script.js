(function($){
  $(document).ready(function(){

    // AJAX Setup
    $.ajaxSetup({
      headers: {
        'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    /**
     * ADD a Student's Information
     */
    //  Modal Show for clicking ADD button
    $(document).on('click','#click_add_student',function(e){
      e.preventDefault();
      $('#add_modal').modal('show');
    });
    // Form Submition
    $(document).on('submit','#add_modal_form',function(e){
      e.preventDefault();
      $.ajax({
        method: "POST",
        route: 'student.store',
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
          $('#errorForCreatingName').text('');
          $('#errorForCreatingEmail').text('');
          $('#errorForCreatingCell').text('');
          $('#errorForCreatingGender').text('');
          $('#errorForCreatingMonthlyDonation').text('');
          $('#add_modal_message').html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>  A Student has been Registered Successfully</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
          $('#add_modal_form')[0].reset();
          let gender = '';
          if(data.gender==0){
            gender='Male';
          }
          else{
            gender='Female';
          }
          $('#all_students_information')
          .prepend(`
            <tr>
              <td class="py-3">`+ data.id +`</td>
              <td class="py-3">`+ data.name +`</td>
              <td class="py-3">`+ data.email +`</td>
              <td class="py-3">`+ data.cell +`</td>
              <td class="py-3">`+ gender +`</td>
              <td class="py-3">`+ data.monthly_donation +`</td>
              <td class="py-3">
                <div class="btn-group" role="group">
                  <button type="button" student-id="`+ data.id +`" id="click_edit_student" class="btn btn-info btn-sm">View</button>
                  <button type="button" student-id="`+ data.id +`" id="click_edit_student" class="btn btn-danger btn-sm">Delete</button>
                  <button type="button" student-id="`+ data.id +`" id="click_edit_student" class="btn btn-success btn-sm">Edit</button>
                </div>
              </td>
            </tr>
          `);
        },
        error:function(error){
          $('#errorForCreatingName').text('');
          $('#errorForCreatingEmail').text('');
          $('#errorForCreatingCell').text('');
          $('#errorForCreatingGender').text('');
          $('#errorForCreatingMonthlyDonation').text('');
          $('#add_modal_message').html('');
          $.each(error.responseJSON.errors,function(index,value){
            if(index=='name'){
              $('#errorForCreatingName').text(value[0]);
            }
            if(index=='email'){
              $('#errorForCreatingEmail').text(value[0]);
            }
            if(index=='cell'){
              $('#errorForCreatingCell').text(value[0]);
            }
            if(index=='gender'){
              $('#errorForCreatingGender').text(value[0]);
            }
            if(index=='monthly_donation'){
              $('#errorForCreatingMonthlyDonation').text(value[0]);
            }
          });
        }
      });
    });
  });
})(jQuery)
