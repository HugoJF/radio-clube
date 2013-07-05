    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->

      <!-- Example row of columns -->
		<h2><?php echo $this->lang->line('control_panel_add_games'); ?></h2>
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
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('general_save'); ?></button>
				<a href="<?php echo base_url('dashboard'); ?>" class="btn"><?php echo $this->lang->line('general_cancel'); ?></a>
			</div>
			</form>

      <hr>

      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>

    </div> <!-- /container -->
