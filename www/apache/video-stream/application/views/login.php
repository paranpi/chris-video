<?php $this -> load -> view('layout/header');?> 
<div class="container">
      <?php echo form_open('/user/login_process','class="form-signin"'); ?>      
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <?php echo form_close(); ?>

</div> <!-- /container -->
<?php $this -> load -> view('layout/footer');?>