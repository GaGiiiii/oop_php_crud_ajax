$(document).ready(function(){

  load_data();

  function load_data(){

    $("#action").val("Insert");

    let action = "Load";
    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        action: action
      },
      success: function(data){
        $('#user_table').html(data);
      }
    });
  }

  $("#user_form").on("submit", function(event){
    event.preventDefault();
    const firstName = $("#first_name").val();
    const lastName = $("#last_name").val();
    const extension = $("#user_image").val().split('.').pop().toLowerCase();
    
    if(extension != ''){
      if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
        alert("Invalid Image File.");
        $("#user_image").val('');

        return false;
      }
    }

    if(firstName != '' && lastName != ''){
      $.ajax({
        url: "action.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data){
          console.log(data);
          $("#user_form")[0].reset();
          load_data();
          $("#action").val("Insert");
          $("#button_action").val("Submit");
          $("#uploaded_image").html('');
        }
      });
    }else{
      alert("Both Fields Are Required.");
    }
  });

  $(document).on('click', '.update', function(){
    const user_id = $(this).attr('id');
    const action = "Fetch Single Data";
    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        user_id: user_id,
        action: action
      },
      dataType: "json",
      success: function(data){
        $('.collapse').collapse("show");
        $("#first_name").val(data.first_name);
        $("#last_name").val(data.last_name);
        $("#uploaded_image").html(data.image);
        $("#hidden_user_image").val(data.user_image);
        $("#button_action").val("Edit");
        $("#action").val("Edit");
        $("#user_id").val(user_id);
        console.log(data);
      }
    });
  });

  $(document).on('click', '#add-user-button', function(){
    if($("#button_action").val() == "Edit"){
      $("#first_name").val('');
      $("#last_name").val('');
      $("#button_action").val("Submit");
      $("#action").val("Insert");
      $("#uploaded_image").html('');
    }
  });

  $(document).on('click', '.delete', function(){
    const user_id = $(this).attr('id');
    const action = "Delete";
    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        user_id: user_id,
        action: action
      },
      success: function(data){
        console.log(data);
        load_data();
      }
    });
  });

});