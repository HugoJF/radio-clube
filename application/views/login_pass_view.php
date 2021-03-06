
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->lang->line('login_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
	  
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?php echo base_url('assets/css/bootstrap-responsive.css');?>" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <div class="container">

      <form method="POST" action="<?php echo base_url('login');?>" class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
		<p class="text-warning"><?php echo $this->session->flashdata('message');?></p>
		<p class="text-error"><?php echo $this->session->flashdata('error');?></p>
		
		<?php if(form_error('identity') !== '') echo form_error('identity'); ?>
        <input name="identity"type="text" class="input-block-level" placeholder="<?php echo $this->lang->line('login_rid'); ?>">

        <input name="password" type="password" class="input-block-level" value="password" placeholder="<?php echo $this->lang->line('login_password'); ?>">
		
        <button class="btn btn-large btn-primary" type="submit"><?php echo $this->lang->line('login_signin'); ?></button>
        <a href="<?php echo base_url() ?>register"><button style="margin-left:30px;" type="button" class="btn btn-large btn-success"><?php echo $this->lang->line('login_register'); ?></button></a>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>

  </body>
</html>
