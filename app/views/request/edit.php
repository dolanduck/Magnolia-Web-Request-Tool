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

  input[type=text] {
    display: block;
    width:250px;
  }

  ul {
    list-style-type: none;
    margin:0px;
    padding:0px;
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
    $publish_date = date('m/d/Y',strtotime($publish_date_db));
    $priority = $key['priority'];
    $request_status = $key['status'];
    $request_description = $key['description'];
    $request_id = $key['id'];

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
        <h3  style="margin:0px;">Web Request <font style="color:green;">#<?php echo $request_number; ?></font>

          <?php if($request_status == 1): ?>
          <span class="badge"style="background: orange;">Open</span>
          <?php else: ?>
             <span class="badge"style="background: green;">Closed</span>
          <?php endif; ?>


          </h3>


        <hr />

        <div class="request_information">
        <form id="editForm" action="<?php echo URL ?>edit/update" method="POST">
            <ul class="request_ul">
              <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">

               <li><b>Requester's Name:</b> <input type="text" name="requester_name" value="<?php echo $requester_name; ?>"></li>
               <li><b>Requester's Phone Number:</b> <input type="text" name="requester_phone" value="<?php echo $requester_phone; ?>"></li>
                <li><b>Desired Publish Date:</b> <input type="text" id="datepicker" name="publish_date" value="<?php echo $publish_date; ?>"></li>
                <li><b>Priority:</b><font style="font-weight:bold;color: <?php echo $color; ?>">

                  <select name="priority" class="form-control" style="margin-bottom:0px;width:25%;">
                  <option value="1" <?php if($priority == 1): ?> selected <?php endif; ?>>High</option>
                  <option value="2" <?php if($priority == 2): ?> selected <?php endif; ?>>Medium</option>
                  <option value="3" <?php if($priority == 3): ?> selected <?php endif; ?>>Low</option>
                  </select>

                </font></li>
                <li><b>Description:</b> <br>
                <textarea class="form-control" name="description" style="width:100%;margin-top:10px;padding:8px;border:1px solid #ccc;"><?php echo $request_description; ?></textarea>
               </li>
               <input type="submit" class="btn btn-green" style="margin-top:25px;" value="Update Request">
            </ul>
        </form>

        </div>
      </div>

</div>



<script type="text/javascript">

$(function() {
  $("#datepicker").datepicker()
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
               location.href="/magnolia/";
            }


          }
        });

     e.preventDefault();
   });


</script>
