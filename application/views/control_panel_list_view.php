
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
      <!-- Main hero unit for a primary marketing message or call to action -->

      <!-- Example row of columns -->
		<?php if($options->num_rows() == 0):?>
		<h2><?php echo $this->lang->line('control_panel_no_games'); ?></h2>
		<?php else: ?>
		<h2><?php echo $this->lang->line('control_panel_game_list'); ?></h2>
		<?php endif; ?>
		<blockquote>
			<ul class="unstyled">
				<?php 
				foreach($options->result() as $option):
				$day = date('l', strtotime($option->value));
				$hours =  date('H', strtotime($option->value));
				$minutes =  date('i', strtotime($option->value));
				?>
				
				<li style="margin-bottom:10px;"><strong><?php echo $day; ?></strong> as <?php echo $hours; ?>:<?php echo $minutes;?>h<a href="<?php echo base_url('control_panel/remove/') ?>/<?php echo $option->id; ?>"><button href="#" style="margin-left:20px;" class="btn btn-danger btn-small" type="button"><?php echo $this->lang->line('general_remove'); ?></button></a></li>
				
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