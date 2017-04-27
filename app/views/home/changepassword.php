<div class="container">
   <div class="col-sm-6 loginBox col-sm-offset-3">
    <h2>Change Password</h2> <hr />
    <form id="passwordForm" action="<?php echo URL ?>changepassword/change" method="POST">

    Current Password: <br>
    <input type="password" name="current_password" class="form-control"> <br>

    New Password: <br>
    <input type="password" name="new_password" class="form-control"> <br>

    Repeat Password: <br>
    <input type="password" name="new_password_repeat" class="form-control"> <br>

    <input type="submit" class="btn btn-green" value="Update Password">


    </form>
   </div>
</div>

<script type="text/javascript">
$("#passwordForm").submit(function(e) {

  var url = $("#passwordForm").attr("action");

  $.ajax({
       type: "POST",
       url: url,
       data: $("#passwordForm").serialize(), // serializes the form's elements.
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
