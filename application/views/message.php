
    <div class="container">
		<div class="row">
			<div class="span12 thumbnail-games">
				<?php if(isset($link)): ?>
					<h1 class="text-center"><a href="<?php echo $link; ?>"><?php echo $message ?></a></h1>
				<?php else: ?>
					<h1 class="text-center"><a href="<?php echo base_url() . 'dashboard'; ?>"><?php echo $message ?></a></h1>
				<?php endif; ?>
			</div>
		</div>
      <hr>

      <footer>
        <p>&copy; <?php echo $this->lang->line('general_footer'); ?></p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>

  </body>
</html>
