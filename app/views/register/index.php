<!--<div class="container">

   <div class="col-sm-6 col-sm-offset-3 loginBox">
     <h2>Register</h2> <hr />
     <div class="form">
       <form id="registerForm" action="<?php echo URL ?>register/create" method="POST">
       Full Name: <br>
       <input type="text" name="full_name" class="form-control"> <br/>
       Email: <br>
       <input type="text" name="email" class="form-control"> <br/>
       Password: <br>
       <input type="password" name="password" class="form-control"> <br/>
       Verify Password: <br>
       <input type="password" name="confirm_password" class="form-control"> <br/>

       <input type="submit" class="btn btn-green" value="Create account">
       </form>
     </div>

   </div>



</div>

<script type="text/javascript">

   $("#registerForm").submit(function(e) {

     var url = $("#registerForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#registerForm").serialize(), // serializes the form's elements.
          success: function(data)
          {
            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
              location.href="/magnolia/home";
            }

          }
        });

     e.preventDefault();
   });

</script>-->
