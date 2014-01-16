			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<section class="global site-meta first">
						<div id="logo-NYCP"><a href="http://nycprepared.org">NYC<span>Prepared</span></a></div>
						<?php bloginfo('description'); ?>
						<ul class="social-links">
						    <li class="email"><a href="mailto:info@nycprepared.org" target="_blank"><i class="entypo-envelope"></i></a>
						    <li class="github"><a href="https://github.com/NYCPrepared/multisite" target="_blank"><i class="entypo-github"></i></a>
						    <li class="twitter"><a href="https://twitter.com/NYCPrepared" target="_blank"><i class="entypo-twitter"></i></a>
						    <li class="facebook"><a href="https://www.facebook.com/nycprepared" target="_blank"><i class="entypo-facebook"></i></a>
						    <li class="rss"><a href="/feed" target="_blank"><i class="entypo-rss"></i></a>
                        </ul>
					</section>
					<section class="widgets ">
						<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
							<?php dynamic_sidebar( 'footer1' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
							<?php dynamic_sidebar( 'footer2' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
							<?php dynamic_sidebar( 'footer3' ); ?>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer4' ) ) : ?>
							<?php dynamic_sidebar( 'footer4' ); ?>
						<?php endif; ?>
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
