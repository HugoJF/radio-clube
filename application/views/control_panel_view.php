    <!-- Main Scripts -->
	<script type="text/javascript">
		function parseHour(elem) {
			var hour = 0;
			if(!isNaN(parseInt(elem.value))) hour = parseInt(elem.value);
			elem.value = Math.max(0, Math.min(parseInt(hour), 24)) + 'h';
			elem2 = document.getElementById('minutes');
			if(isNaN(parseInt(elem2.value)) || elem2.value == '') {
				elem2.value = '0min';
			}
		}
		function parseMinutes(elem) {
			var hour = 0;
			if(!isNaN(parseInt(elem.value))) hour = parseInt(elem.value);
			elem.value = Math.max(0, Math.min(parseInt(hour), 60)) + 'min';
		
		}
		function validateForm(elem) {
			if(elem['hours'].value == '') {
				alert('<?php echo $this->lang->line('error_insert_hours'); ?>');
				return false;
			}
			if(elem['minutes'].value == '') {
				alert('<?php echo $this->lang->line('error_insert_minutes'); ?>');
				return false;
			}
			return true;
		}
	</script>
	
	<div class="container">

      <!-- Form for adding new games -->
	  
		<h2><?php echo $this->lang->line('control_panel_add_games'); ?></h2>
		
		<form method="POST" action="<?php echo base_url('control_panel/add'); ?>" class="form-horizontal" onsubmit="return validateForm(this);">
			<div class="control-group">
				<label class="control-label"><?php echo $this->lang->line('general_day'); ?>: </label>
				<div class="controls">
					<select name="day">
						<option value="Sunday" >  <?php echo $this->lang->line('general_sunday');    ?></option>
						<option value="Monday">   <?php echo $this->lang->line('general_monday');    ?></option>
						<option value="Tuesday">  <?php echo $this->lang->line('general_tuesday');   ?></option>
						<option value="Wednesday"><?php echo $this->lang->line('general_wednesday'); ?></option>
						<option value="Thursday"> <?php echo $this->lang->line('general_thurday');   ?></option>
						<option value="Friday">   <?php echo $this->lang->line('general_friday');    ?></option>
						<option value="Saturday"> <?php echo $this->lang->line('general_saturday');  ?></option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label"><?php echo $this->lang->line('general_hour'); ?>: </label>
				<div class="controls">
					<input data-toggle="tooltip" id="hours" name="hours" class="input-mini " type="text" placeholder="24h" onblur="parseHour(this);">
					<input data-toggle="tooltip" id="minutes" name="minutes" class="input-mini" type="text" placeholder="60min" onblur="parseMinutes(this);">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('general_save'); ?></button>
					<a href="<?php echo base_url('dashboard'); ?>" class="btn"><?php echo $this->lang->line('general_cancel'); ?></a>
				</div>
			</div>
		</form>
		
		<!-- End form for adding games -->
		<!-- List programmed games -->
		
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
		
		<!-- End list programmed games -->
		<!-- Footer -->
		
      <hr>
      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>
	  
	  <!-- End footer -->

    </div> <!-- /container -->
