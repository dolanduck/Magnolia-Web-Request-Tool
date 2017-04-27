<style>
  .table-heading td:not(:last-child) {
    border-right: 2px dashed rgb(198,213,47);
  }

  .table {
    background: #ffffff;
    border:1px solid #ccc;
  }

  .request_ul li {
    border-bottom:1px dashed #ccc;
    padding:10px;
  }

  button {
    border:0px;
    background: none;
    font-size:13px;
    color:#666666;
    outline: 0;
  }



</style>

<?php

if(!empty($request))
{
  foreach($request as $key)
  {

    $request_number = $key['request_number'];
    $requester_phone = $key['client_phone'];
    $requester_name = $key['client'];
    $publish_date_db = $key['publish_date'];
    $publish_date = date('m-d-Y',strtotime($publish_date_db));
    $priority = $key['priority'];
    $request_status = $key['status'];
    $request_description = $key['description'];

  }

  switch($priority) {
    case 1:
    $priorityCase = 'High';
    $color = 'red';
    break;

    case 2:
    $priorityCase = 'Medium';
    $color = 'orange';
    break;

    case 3:
    $priorityCase = 'Low';
    $color = 'blue';
    break;
  }
}

?>

<div class="container">

  <div class="col-xs-12" style="margin-top:40px;padding:0px;">


        <div class="box" style="border:1px solid #ccc;background: white;padding:40px;">
        <h3 class="pull-left" style="margin:0px;">Web Request <font style="color:green;">#<?php echo $request_number; ?></font>

          <?php if($request_status == 1): ?>
          <span class="badge"style="background: orange;">Open</span>
          <?php else: ?>
             <span class="badge"style="background: green;">Closed</span>
          <?php endif; ?>


          </h3>

          <div class="pull-right buttons">
          <?php if($request_status == 1): ?>
          <form id="closeForm" style="display:inline-block;" action="<?php echo URL ?>close" method="POST">
          <input type="hidden" name="request_number" value="<?php echo $request_number; ?>">
          <input type="submit" class="btn btn-green" value="Close Request">
          </form>
          <?php endif; ?>

          <form id="editForm" style="display:inline-block;" action="<?php echo URL ?>edit" method="POST">
          <input type="hidden" name="request_number" value="<?php echo $request_number; ?>">
          <input type="submit" class="btn btn-green" value="Edit">
          </form>

          </div>

          <div class="clearfix"></div>
        <hr />

        <div class="request_information">
          <ul class="request_ul">
             <li><b>Requester's Name:</b> <?php echo $requester_name; ?></li>
             <li><b>Requester's Phone Number:</b> <?php echo $requester_phone; ?></li>
              <li><b>Desired Publish Date:</b> <?php echo $publish_date; ?></li>
              <li><b>Priority:</b><font style="font-weight:bold;color: <?php echo $color; ?>"> <?php echo $priorityCase; ?> </font></li>
              <li><b>Description:</b> <br>
              <div style="background-color:#f1f1f1;padding:20px;margin-top:5px;border-radius:5px;">
                <?php echo $request_description; ?>
              </div>
             </li>

             <h4>Status feed</h4>
             <form id="statusForm" action="<?php echo URL ?>show/postStatus" method="POST">
             <input type="hidden" name="request_number" value="<?php echo $_GET['request']; ?>">
             <textarea name="status" class="form-control" style="width:50%;height:70px;border:1px solid #ccc;padding:8px;"></textarea> <br/>
             <input type="submit" class="btn btn-green" value="Post Status">
             </form>

             <hr />
             <?php foreach($status as $stat) {
               $status_content = $stat['status_content'];
               $posted_by = $stat['posted_by'];
               $status_id = $stat['id'];
               $date_db = $stat['status_date'];
               $date = date('m-d-Y g:i a',strtotime($date_db));
             ?>
             <div class="status-row" style="margin-bottom:15px;">
               <div style="background-color:#f8f8f8;padding:15px 15px 5px 15px;margin-top:5px;border-radius:5px;margin-bottom:7px;">
               <p><?php echo $status_content; ?></p>
               </div>

                 <span class="details pull-left" style="color:#666666;font-size:13px;font-style:italic;"><?php echo $posted_by; ?> - <?php echo $date; ?></span>
                 <span class="settings pull-right" style="font-size:13px;">



                    <form id="removeStatusForm" style="display: inline-block;" action="<?php echo URL ?>show/removeStatus" method="POST">
                     <input type="hidden" name="status_id" value="<?php echo $status_id; ?>">
                     <button type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </form>

                </span>

               <div class="clearfix"></div>

            </div>
            <?php } ?>

          </ul>

        </div>
      </div>

</div>



<script type="text/javascript">

   $("#statusForm").submit(function(e) {

     var url = $("#statusForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#statusForm").serialize(),
          success: function(data)
          {

            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
               location.reload();
            }


          }
        });

     e.preventDefault();
   });


   $("#closeForm").submit(function(e) {

     var url = $("#closeForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#closeForm").serialize(),
          success: function(data)
          {

            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
              location.href="/magnolia/"
            }


          }
        });

     e.preventDefault();
   });

   $("#editForm").submit(function(e) {

     var url = $("#editForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#editForm").serialize(),
          success: function(data)
          {

            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
               location.reload();
            }


          }
        });


   });

   $("#editStatusForm").submit(function(e) {

     var url = $("#editStatusForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#editStatusForm").serialize(),
          success: function(data)
          {

            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
               location.reload();
            }


          }
        });

     e.preventDefault();
   });


   $("#removeStatusForm").submit(function(e) {

     var url = $("#removeStatusForm").attr("action");

     $.ajax({
          type: "POST",
          url: url,
          data: $("#removeStatusForm").serialize(),
          success: function(data)
          {

            if(data.type == 'error')
            {
              alert(data.message); // show response from the php script.
            }

            else if(data.type == 'success')
            {
               location.reload();
            }


          }
        });

     e.preventDefault();
   });






</script>
