<div class="container">

   <div class="col-sm-6 col-sm-offset-3 loginBox">
     <h2>Sign In</h2> <hr />
     <div class="form">
       <form id="loginForm" action="<?php echo URL ?>login/validate" method="POST">
       Email: <br>
       <input type="text" name="email" class="form-control"> <br/>
       Password: <br>
       <input type="password" name="password" class="form-control"> <br/>

       <input type="submit" class="btn btn-green" value="Sign In">
       </form>
     </div>

   </div>

</div>

<script type="text/javascript">

   $("#loginForm").submit(function(e) {

     var url = $("#loginForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#loginForm").serialize(), // serializes the form's elements.
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

</script>
