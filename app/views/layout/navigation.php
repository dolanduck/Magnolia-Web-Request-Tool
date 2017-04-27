<div class="navbar navbar-default">
  <div class="container">
    <?php

      $segment = isset($_GET['url']) ? $_GET['url']: null;
      $segment = rtrim($segment, '/');
      $segment = explode('/', $segment);


     ?>

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand">Quest Diagnostics - Web Requests</a>
    </div>

    <div class="navbar-collapse collapse">
      <?php if(isset($_SESSION['loggedIn']) == true): ?>
      <ul class="nav navbar-nav navbar-right">
        <li <?php if($segment[0] == '' || $segment[0] == 'home'): ?>class="active" <?php endif; ?>><a href="<?php echo URL ?>">Open Requests</a></li>
        <li <?php if($segment[0] == 'closedrequests'): ?> class="active" <?php endif; ?>><a href="<?php echo URL ?>closedrequests">Closed Requests</a></li>
        <li <?php if($segment[0] == 'addrequest'): ?> class="active" <?php endif; ?>><a href="<?php echo URL ?>addrequest">Add Request</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $fullname; ?> <span class="caret"></span></a>

           <ul class="dropdown-menu">
            <li><a href="<?php echo URL ?>changepassword">Change Password</a></li>
            <li><a href="<?php echo URL?>logout">Logout</a></li>
           </ul>

        </li>
      </ul>
     <?php else: ?>
       <ul class="nav navbar-nav navbar-right">
         <li class="active"><a href="<?php echo URL ?>login">Sign In</a></li>
       </ul>
     <?php endif; ?>
    </div>

  </div>
</div>
