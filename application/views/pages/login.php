<div class="container">
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 text-center mt-2">
      <h3>Login Form</h3>
      <?php if($this->session->flashdata('loggedOut')): ?>
        <div class="bg-dark text-white rounded shadow"> <?= $this->session->flashdata('loggedOut'); ?> </div>
      <?php endif; ?>
      <div class="bg-danger text-white rounded shadow"><?= $validationErrors; ?></div>
        <form class="mt-3" method="POST" action="validation">

          <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Enter your username" value="<?php echo set_value('username'); ?>">
            <span class="text-danger"><?php echo form_error('username'); ?></span>
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter your password"/>
            <span class="text-danger"><?php echo form_error('password'); ?></span>
          </div>

          <div class="form-group">
            <input class="btn btn-block btn-dark mt-1" type="submit" value="Login">
          </div>
        </form>
        
    </div>
    <div class="col-4"></div>
  </div>
</div>