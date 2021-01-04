<div class="container">
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 text-center mt-2">
      <h3>Registration Form</h3>
      <div class="bg-success text-white rounded shadow"><?= $successfull; ?></div>
        <form class="mt-4" method="POST" action="validation">

          <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Type your name" value="<?php echo set_value('username');?>">
            <span class="text-danger"><?php echo form_error('username');?></span>
          </div>

          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Type your email" value="<?php echo set_value('email'); ?>" />
            <span class="text-danger"><?php echo form_error('email');?></span>
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Type your password" value="<?php echo set_value('password'); ?>" />
            <span class="text-danger"><?php echo form_error('password');?></span>
          </div>

          <div class="form-group">
            <input class="btn btn-block btn-dark mt-1" type="submit" value="Register">
          </div>
        </form>

        
    </div>
    <div class="col-4"></div>
  </div>
</div>