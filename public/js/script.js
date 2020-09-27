(function($){
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });

    // ADD a Student's Information
    $(document).on('click','#click_add_student',function(){
      $('#add_modal').modal('show');
    });
  });
})(jQuery)
