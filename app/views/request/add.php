<div class="container">
  <div class="container">

     <div class="col-xs-12">
       <h2 class="text-center">Add Web Request</h2> <hr />
       <form id="requestForm" enctype="multipart/form-data" action="<?php echo URL ?>addRequest/process" method="POST">

       <div class="formR col-sm-6 col-sm-offset-3 requestBox" style="padding-top:35px;">

         Web Request #: <sup style="color:red;">*</sup> <br>
         <input type="text" name="request_number" class="form-control"> <br/>

         Client's name: <sup style="color:red;">*</sup><br>
         <input type="text" name="requester_name" class="form-control"> <br/>

         Client's Phone Number: <sup style="color:red;">*</sup><br>
         <input type="text" name="requester_phone" class="form-control"> <br/>

         Desired Publish Date: <sup style="color:red;">*</sup><br>
         <input type="text" id="datepicker" name="publish_date" class="form-control"> <br/>

         Priority: <sup style="color:red;">*</sup><br>
         <select name="priority" class="form-control" style="margin-bottom:20px;">
         <option value="1">High</option>
         <option value="2" selected>Medium</option>
         <option value="3">Low</option>
         </select>

         Description: <sup style="color:red;">*</sup><br>
         <textarea class="form-control" name="description" style="height:120px;margin-bottom:20px;"></textarea>

         <input type="submit" class="btn btn-green" value="Submit">

         </div>
         </form>

       <!--<div class="form col-sm-6">


         <!--Upload assets zip file: <br>
         <input name="file[]" type="file" id="file"/><br>

         Description: <sup style="color:red;">*</sup><br>
         <textarea class="form-control" name="description" style="height:120px;"></textarea> <br>-->


      <!--   <input type="submit" class="btn btn-green" value="Submit">
      </div>-->

        </form>



     </div>

  </div>

  <script type="text/javascript">

  $(function() {
    $("#datepicker").datepicker()
  });

     $("#requestForm").submit(function(e) {

       var url = $("#requestForm").attr("action");

       $.ajax({
            type: "POST",
            url: url,
            data: $("#requestForm").serialize(),
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


</div>
