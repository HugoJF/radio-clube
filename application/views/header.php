<?php

	$CI =& get_instance();
	$the_user = $CI->ion_auth->user()->row();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
	<?php  if(isset($title)): ?>
	<title><?php echo $title; ?></title>
	<?php else: ?>
    <title>Radio Clube</title>
	<?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">

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

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php $this->load->helper('text'); echo base_url(); ?>"><?php echo $this->lang->line('general_radioc'); ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
			
				<?php if($this->ion_auth->logged_in()): ?><li><a href="<?php echo base_url();?>dashboard/"               ><?php echo $this->lang->line('header_index'); ?>         </a></li><?php endif; ?>
				<?php if($this->ion_auth->logged_in()): ?><li><a href="<?php echo base_url();?>presence/"                ><?php echo $this->lang->line('header_presences'); ?>     </a></li><?php endif; ?>
				<?php if($this->ion_auth->is_admin()):  ?><li><a href="<?php echo base_url();?>control_panel/"           ><?php echo $this->lang->line('header_control_panel'); ?> </a></li><?php endif; ?>
				<?php if($this->ion_auth->logged_in()): ?><li><a href="<?php echo base_url();?>logout/"                  ><?php echo $this->lang->line('header_logout'); ?>        </a></li><?php endif; ?>
              
            </ul>
            <div class="navbar-form pull-right">
              <ul class="nav">
				<li><a href="#"><strong><?php if(isset($the_user->username)) echo $the_user->first_name . ' ' . $the_user->last_name . ' (' . $the_user->username . ')'; ?></strong></a></li>
			  </ul>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>