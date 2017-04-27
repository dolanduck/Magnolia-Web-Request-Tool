<style>
  .table-heading td:not(:last-child) {
    border-right: 2px dashed rgb(198,213,47);
  }

  .table {
    background: #ffffff;
    border:1px solid #ccc;
  }

</style>

<div class="container">

  <div class="col-xs-12">
    <h2 style="margin-bottom:5px;">Open Web Requests</h2>
    <small style="font-style:italic;">There are <b><?php echo count($requests); ?></b> open web requests.</small>
     <table class="table" style="margin-top:20px;">
        <tr class="table-heading" style="font-weight:bold;background: rgb(53,121,42);color:white;">
          <td>#</td>
          <td>Client</td>
          <td>Client Contact #</td>
          <td>Desired Publish Date</td>
          <td>Priority</td>
        </tr>
        <?php foreach($requests as $fetch): ?>

          <?php

                  $request_number = $fetch['request_number'];
                  $client_name = $fetch['client'];
                  $client_phone = $fetch['client_phone'];
                  $publish_date = $fetch['publish_date'];
                  $priority = $fetch['priority'];


                  $newDate = date('m-d-Y',strtotime($publish_date));

                  switch($priority) {
                    case 1:
                    $priority = 'High';
                    $color = 'red';
                    break;

                    case 2:
                    $priority = 'Medium';
                    $color = 'orange';
                    break;

                    case 3:
                    $priority = 'Low';
                    $color = 'blue';
                    break;
                  }
           ?>


        <tr style="border-bottom:2px dashed #ccc;">
          <td><a href="<?php echo URL ?>show?request=<?php echo $request_number; ?>"><?php echo $request_number; ?></a></td>
          <td><?php echo $client_name; ?></td>
          <td><?php echo $client_phone; ?></td>
          <td><?php echo $newDate; ?></td>
          <td style="color:<?php echo $color; ?>;"><?php echo $priority; ?></td>
        </tr>

      <?php endforeach; ?>


     </table>
  </div>


</div>
