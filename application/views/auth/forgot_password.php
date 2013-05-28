<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('partials/header', array('page_title' => 'Sign in &middot; Twitter Bootstrap')); ?>

<body class="login-page">

<div class="container">
	<div class="logo-wrapper">
		<ul class="logo-items center">
			<li class="first"><a href="#"><img src="<?php print base_url(); ?>assets/img/logo_sunpharma.png" /></a></li>
			<li class="last"><a href="#"><img src="<?php print base_url(); ?>assets/img/doctor_info.png" /></a></li>
		</ul>
	</div>

  <?php echo form_open("auth/forgot_password",'class="form form-signin"'); ?>


    <div class="row-username">
      <label>Enter Your registered email address to <b>retrive<br/> your password</b></label>
      <?php echo form_input($email);?>
    </div>
		<div class="row-action">
			<button class="btn btn-success btn-primary" type="submit" name="submit">Submit</button>
      <?php print anchor('/', 'back'); ?>
		</div>


    <?php echo form_close();?>

	</div> <!-- /container -->

	<!--[if IE]>
  <script>Modernizr.load({
    test: Modernizr.input.placeholder,
    nope: ['Placeholder.js'],
    complete: function(){Placeholders.init();}
  });
  </script><![endif]-->

  <?php $this->carabiner->display('js'); ?>


</body>
</html>
