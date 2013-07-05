
    <div class="container">
		<?php if($this->session->flashdata('message') != ''): ?>
		<div class="alert fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $this->session->flashdata('message'); ?>
		</div>
		<?php endif; ?>
		
		<?php if($this->session->flashdata('error') != ''): ?>
		<div class="alert alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<?php echo $this->session->flashdata('error'); ?>
		</div>
		<?php endif; ?>
		<?php if($presences->num_rows() == 0): ?>
		<h2><?php echo $this->lang->line('presence_not_present'); ?></h2>
		<?php else: ?>
		<h2><?php echo $this->lang->line('presence_list'); ?></h2>
		<?php endif; ?>
		<blockquote>
			<ul class="unstyled">
				<?php foreach($presences->result() as $presence): ?>
				<li style="margin-bottom:10px;"><strong><?php echo $this->lang->line('presence_game'); ?> 
				<?php echo $presence->id_game ?>
				</strong> - 
				<?php echo date('d/m \a\s G:i\h', strtotime($games_info[$presence->id_game]->date)); ?>
				<a href="<?php echo base_url('presence/remove/' . $presence->id) ?>">
				<button href="#" style="margin-left:20px;" class="btn btn-danger btn-small" type="button"><?php echo $this->lang->line('general_remove'); ?></button></a></li>
				
				<?php  
				endforeach;
				?>
			</ul>
		</blockquote>
      
		<div class="form-actions">
			<br><br>
		</div>
	  <hr>

      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>

    </div> <!-- /container -->