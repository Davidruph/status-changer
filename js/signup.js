$(document).ready(function(){

 $('#signup_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"signupController.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function()
   {
    $('#loader').show();
   },
   success:function(data)
   {
    $('#loader').hide();
    if(data.success)
    {
     $('#email_validation_form')[0].reset();
     $('#email_error').hide();
     $('#name_error').hide();
     $('#mobile_error').hide();
     $('#password_error').hide();
     $('#confirmpassword_error').hide();
      $('#email_text').val(data.email_text_val);
     $('#msg_success').show();
       $('#msg_success').html('Registered! Pls login <a href="signin.php">here</a>');
     //alert('Form Successfully validated');
    }
    else
    {
     $('#email_error').html(data.email_error);
     $('#captcha_error').text(data.captcha_error);
    }
   }
  })
 });

});