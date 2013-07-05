
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->

      <!-- Example row of columns -->
      <div class="row">
	  
		<p class="text-center">
		
			<a href="<?php echo base_url() ?>register/with_token/"><button class="btn btn-large btn-success" type="button"><?php echo $this->lang->line('register_with_token'); ?></button></a>
			<a href="<?php echo base_url() ?>register/without_token/"><button class="btn btn-large btn-danger" type="button"><?php echo $this->lang->line('register_without_token'); ?></button></a>
			
		</p>
		
      </div>
		<div class="form-actions"><br><br></div>
      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>

    </div> <!-- /container -->
