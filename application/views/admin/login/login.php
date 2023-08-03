<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/partisi/head.php'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>Hallo </b>Admin</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo base_url('admin/login/actionlogin') ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required value="<?php if(isset($_COOKIE['remember'])){echo $_COOKIE['remember']; } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3 embed-responsive">
          <div class="input-group">
              <input type="text" name="number_1" class="form-control" readonly value="<?php echo $number_1; ?>" style="background-color:whitesmoke; text-align:center;">
              <div class="input-group-prepend">
                  <span class="input-group-text"> + </span>
              </div>
              <input type="text" name="number_2" class="form-control" readonly value="<?php echo $number_2; ?>" style="background-color: whitesmoke; text-align:center;">
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Berapa hasil diatas" name="captcha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-robot"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE['remember'])){?> checked <?php }; ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?php $this->load->view('admin/partisi/js.php'); ?>
<script>
<?php if(isset($_GET['form'])): ?>
swal('Username atau Password Salah');
<?php endif; ?>
<?php if(isset($_GET['captcha'])): ?>
swal('Captcha Salah');
<?php endif; ?>
</script>
</body>
</html>
