<footer>
	MAIN FOOTER
	<div id="zo-footer-top">
		<div class="container">
			<div class="row">
				<?php if (is_active_sidebar('sidebar-5')) : ?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 footer-first"><?php dynamic_sidebar('sidebar-5'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('sidebar-6')) : ?>
					<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 footer-second"><?php dynamic_sidebar('sidebar-6'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('sidebar-7')) : ?>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-third"><?php dynamic_sidebar('sidebar-7'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('sidebar-8')) : ?>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-four"><?php dynamic_sidebar('sidebar-8'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="zo-footer-bottom">
		 <div class="container">
			 <div class="row">
				 <?php if (is_active_sidebar('sidebar-9')) : ?>
					 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bottom-first"><?php dynamic_sidebar('sidebar-9'); ?></div>
				 <?php endif; ?>
				 <?php if (is_active_sidebar('sidebar-10')) : ?>
					 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bottom-second"><?php dynamic_sidebar('sidebar-10'); ?></div>
				 <?php endif; ?>
			 </div>
		 </div>
	</div>
</footer><!-- #site-footer -->