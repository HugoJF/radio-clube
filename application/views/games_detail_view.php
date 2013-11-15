<?php
	$CI =& get_instance();
?>
<div class="container">

	<!-- Main hero unit for a primary marketing message or call to action -->

	<!-- Example row of columns -->
	<div class="row">
		<h2><?php echo $this->lang->line('game_details'); ?> <?php echo $game->first_row()->id; ?></h2>
		<blockquote>
			<ul class="unstyled">
				<li><strong><?php echo $this->lang->line('game_date'); ?>
						: </strong><?php echo date('d/m \a\s G:i\h', strtotime($game->first_row()->date)); ?></li>
				<li><strong><?php echo $this->lang->line('game_present_users'); ?>
						: </strong><?php echo $CI->radioc_model->get_presence_number($game->first_row()->id) ?></li>
			</ul>
			<h3><?php echo $this->lang->line('game_presence_list'); ?>:</h3>
			<ul>
				<?php if ($game_presences->num_rows() == 0): ?>
					<li><?php echo $this->lang->line('game_no_present'); ?></li>
				<?php endif;
					foreach ($game_presences->result() as $presence):
						$user = $CI->radioc_model->get_user($presence->id_user)->first_row();
						?>
						<li><?php if (isset($user->username)) {
								echo $user->first_name . ' ' . $user->last_name . (($user->rid != '') ? '(' . $user->rid . ')' : '');
							} else {
								echo 'Invalid User';
							}
							?></li>
					<?php endforeach; ?>
			</ul>
		</blockquote>
		<div class="form-actions">
			<br><br>
		</div>
	</div>
	<hr>

	<footer>
		<p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
	</footer>

</div> <!-- /container -->