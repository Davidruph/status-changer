
$(document).ready(function(){

 $('#email_validation_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"validate_email.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function()
   {
    $('#spinDiv').show();
   },
   success:function(data)
   {
    $('#spinDiv').hide();
    if(data.success)
    {
     $('#email_validation_form')[0].reset();
     $('#email_error').hide();
     $('#captcha_error').hide();
     $('#resultImage').hide();
      $('#email_text').val(data.email_text_val);
     $('#email_success').show();
     $('#result').show();
      $('#email_text_val').html(data.email_text_val);
       $('#email_success').html('Nice, It is Safe and Deliverable');
     grecaptcha.reset();
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