
    <div id="data" class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->

      <!-- Example row of columns -->
      <hr>

      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
	
	<script type="text/javascript">
		var last_id = 0;
		$('document').ready(function(){
			checkNotifications();
			setInterval('checkNotifications()', 1000);
		})
		
		
		function checkNotifications() {
			console.log('checking notifications...');
			$.ajax({
				type: 'get',
				dataType: 'json',
				url:'<?php echo base_url('ajax/get_new_notifications/') ?>' + '/' + last_id + '/',
				success: function(data){
					for(i = 0; i < data.length; i++) {
					
						if(last_id <= parseInt(data[i].id)) {
							last_id = data[i].id;
							console.log(data[i].id);
						}
						
						if(data[i].type == 'ERROR') {
							$('#data').prepend('<div class="row hidden-notification"><div class="span12 thumbnail-games"><h4 class="text-error text-center">[ERROR | ' + data[i].date + ']: ' + data[i].text + '</h4></div></div>');
						} else if(data[i].type == 'MESSAGE') {
							$('#data').prepend('<div class="row hidden-notification"><div class="span12 thumbnail-games"><h4 class="text-info text-center">[MESSAGE | ' + data[i].date + ']: ' + data[i].text + '</h4></div></div>');
						} else {
							console.log('Error in notification type');
						}
						
						
					}
					$('.hidden-notification').fadeIn('slow');
				}
			})  
		}
	</script>

  </body>
</html>
