(function($){
  $(document).ready(function(){

    // AJAX Setup
    $.ajaxSetup({
      headers: {
        'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

   /**
    ******************************************************************************
    *****************View All Students' Information*********************************
    ******************************************************************************
    */
     function getAllStudentsData(){
       $.ajax({
         url: '/getStudentsData',
         method: 'POST',
         cache: false,
         dataType: 'json',
         success: function(dataResult){
           var resultData = dataResult.data;
           var all_students_information = '';
           var i=1;
           // Creating Foreach Loop to print all data
           $.each(resultData,function(index,row){
             let gender = (row.gender == 0) ? 'Male' : 'Female';
             all_students_information+=`
             <tr>
               <td class="py-3">`+ i++ +`</td>
               <td class="py-3">`+ row.name+`</td>
               <td class="py-3">`+ row.email+`</td>
               <td class="py-3">`+ row.cell+`</td>
               <td class="py-3">`+ gender +`</td>
               <td class="py-3">`+ row.monthly_donation+`</td>
               <td class="py-3">
                 <div class="btn-group" role="group">
                   <button type="button" student_id="`+ row.id+`" id="click_edit_student" class="btn btn-info btn-sm">View</button>
                   <button type="button" student_id="`+ row.id+`" id="click_edit_student" class="btn btn-danger btn-sm">Delete</button>
                   <button type="button" student_id="`+ row.id+`" id="click_edit_student" class="btn btn-success btn-sm">Edit</button>
                 </div>
               </td>
             </tr>
             `;
           });
           $("#all_students_information").prepend(all_students_information);
         }
       });
     }
     getAllStudentsData();

   /**
    ******************************************************************************
    *****************ADD a Student's Information**********************************
    ******************************************************************************
    */
    //  Modal Show for clicking ADD NEW STUDENT button
    $(document).on('click','#click_add_student',function(e){
      e.preventDefault();
      // Clearing all Previous Messages for validation or Success
      $('#errorForCreatingName').text('');
      $('#errorForCreatingEmail').text('');
      $('#errorForCreatingCell').text('');
      $('#errorForCreatingGender').text('');
      $('#errorForCreatingMonthlyDonation').text('');
      $('#add_modal_message').html('');

      $('#add_modal').modal('show');
    });
    // Form Submition By Clicking ADD Button
    $(document).on('submit','#add_modal_form',function(e){
      e.preventDefault();
      $.ajax({
        method: "POST",
        route: 'student.store',
        data: new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
          // Clearing all Previous Messages for validation
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
          // Adding a New Student's Information
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
          // getAllStudentsData();
        },
        error:function(error){
          // Clearing all Previous Messages for validation or Success
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


    /**
     ******************************************************************************
     *****************Edit a Student's Information*********************************
     ******************************************************************************
     */
    //  Modal Show for clicking EDIT button
    $(document).on('click','#click_edit_student',function(e){
      e.preventDefault();
      let student_id = $(this).attr('student_id');
      $.ajax({
        url: 'student/'+student_id+'/edit',
        method: 'GET',
        success:function(data){
          // Get & Set all data from single student's info
          $('#edit_modal_student_id').val(data[0].id);
          $('#edit_modal_student_name').val(data[0].name);
          $('#edit_modal_student_email').val(data[0].email);
          $('#edit_modal_student_cell').val(data[0].cell);
          $('#edit_modal_student_gender').val(data[0].gender);
          $('#edit_modal_student_monthly_donation').val(data[0].monthly_donation);
        },
        error:function(error){
          console.log(error);
        }
      });
      // Clearing all Previous Messages for validation or Success
      $('#errorForUpdatingName').text('');
      $('#errorForUpdatingEmail').text('');
      $('#errorForUpdatingCell').text('');
      $('#errorForUpdatingGender').text('');
      $('#errorForUpdatingMonthlyDonation').text('');
      $('#edit_modal_message').html('');
      $('#edit_modal').modal('show');
    });
    // Form Submition By Clicking ADD Button
    $(document).on('submit','#edit_modal_form',function(e){
      e.preventDefault();
      let student_id = $('#edit_modal_student_id').val();
      let updated_name = $('#edit_modal_student_name').val();
      let updated_email = $('#edit_modal_student_email').val();
      let updated_cell = $('#edit_modal_student_cell').val();
      let updated_gender = $('#edit_modal_student_gender').val();
      let updated_monthly_donation = $('#edit_modal_student_monthly_donation').val();
      $.ajax({
        url: 'student/'+student_id,
        method: 'PUT',
        data: {
          id: student_id,
          name: updated_name,
          email: updated_email,
          cell: updated_cell,
          gender: updated_gender,
          monthly_donation: updated_monthly_donation,
        },
        success:function(data){
          $("#all_students_information").html('');
          getAllStudentsData();
          $('#edit_modal_message').html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>  A Student has been Updated Successfully</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
        },
        error:function(error){
          // Clearing all Previous Messages for validation or Success
          $('#errorForUpdatingName').text('');
          $('#errorForUpdatingEmail').text('');
          $('#errorForUpdatingCell').text('');
          $('#errorForUpdatingGender').text('');
          $('#errorForUpdatingMonthlyDonation').text('');
          $('#edit_modal_message').html('');
          $.each(error.responseJSON.errors,function(index,value){
            if(index=='name'){
              $('#errorForUpdatingName').text(value[0]);
            }
            if(index=='email'){
              $('#errorForUpdatingEmail').text(value[0]);
            }
            if(index=='cell'){
              $('#errorForUpdatingCell').text(value[0]);
            }
            if(index=='gender'){
              $('#errorForUpdatingGender').text(value[0]);
            }
            if(index=='monthly_donation'){
              $('#errorForUpdatingMonthlyDonation').text(value[0]);
            }
          });
        },
      });
    });
  });
})(jQuery)
