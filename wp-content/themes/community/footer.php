			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<section class="global site-meta first">
						<div class="logo">{NYC:Prepared Logo}</div>
						<?php bloginfo('description'); ?>
						<div class="social links icons">
							<ul class="social-links">
								<li class="facebook"><span class="icon-facebook"></span></li>
								<li class="twitter"><span class="icon-twitter"></span></li>
							</ul>
						</div>
					</section>
					<section class="widgets ">
						<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
							<?php dynamic_sidebar( 'footer1' ); ?>
						<?php endif; ?>

						<div class="right widgets">
							<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
								<?php dynamic_sidebar( 'footer2' ); ?>
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
								<?php dynamic_sidebar( 'footer3' ); ?>
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer4' ) ) : ?>
								<?php dynamic_sidebar( 'footer4' ); ?>
							<?php endif; ?>
						</div>

					</section>
					
				</div>

				<nav role="navigation clearfix">
					<?php bones_footer_links(); ?>
				</nav>

				<div class="source-org copyright clearfix">Copyleft <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. </div>
			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html>
