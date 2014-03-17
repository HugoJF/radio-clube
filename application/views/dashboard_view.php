
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
		  
		<?php if($available_games->num_rows() == 0): ?>
			<h2><?php echo $this->lang->line('dashboard_no_games_available'); ?></h2>
		<?php  else: ?>
		<?php
			for($i = 0; $i < $available_games->num_rows(); $i++):
				if($i % 3 === 0):
				?>
				<div class="row">
				<?php
				endif;
				?>
				<div class="span4 thumbnail-games">
					<a href="<?php echo base_url('games/detail/' . $available_games->row($i)->id) ?>"><h2 class="text-center">Jogo <?php echo $i + 1 ?></h2></a>
				  <h4 class="text-center"><?php echo date("d/m \a\s G:i\h", strtotime($available_games->row($i)->date)) ?></h4>
				  <p class="text-center"><?php echo sprintf($this->lang->line('dashboard_remaining_slots'), $this->radioc_model->get_max_users_game() - $this->radioc_model->get_presence_number($available_games->row($i)->id)); ?></p>
				<?php if(!$this->radioc_model->is_user_present($this->ion_auth->user()->row()->id, $available_games->row($i)->id)):?>
					<p class="text-center"><a class="btn btn-primary" href="<?php echo base_url('presence/add/') . '/' . $available_games->row($i)->id ?>"><?php echo $this->lang->line('dashboard_add_presence'); ?> &raquo;</a></p>
				<?php else: ?>
					<p class="text-center"><span class="schedule-game"><a class="schedule btn btn-success" href="#">Marcado</a><a class="unschedule btn btn-danger" href="<?php echo base_url('presence/remove_dash/' . $this->ion_auth->user()->row()->id . '/' . $available_games->row($i)->id) ?>"><?php echo $this->lang->line('dashboard_remove_presence'); ?></a></span></p>
				 <?php endif; ?>
				</div>
				<?php
				if(($i + 1) % 3 === 0 || $i == $available_games->num_rows() -1 ):
				?>
				</div>
				<?php
				endif;
			endfor;
			?>
		<?php endif; ?>
		<div class="form-actions">
			<br><br>
		</div>
		<hr>
		<footer>
			<p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
		</footer>
    </div> <!-- /container -->