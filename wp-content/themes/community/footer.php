			<footer class="footer" role="contentinfo">

				<div class="wrap">

					<section class="global site-meta first">
						<h2 class="footer-logo"><a class="logo-NYCP" href="<?php echo home_url(); ?>">NYC<span>Prepared</span></a><span class="tagline-NYCP"><?php bloginfo('description'); ?></span></h2>
					</section>
					
					<section class="widgets">
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
					

    				<nav class="footer-nav" role="navigation clearfix">
    					<?php bones_footer_links(); ?>
    				</nav>
    
    
    
				</div>
				
			</footer>


			<footer class="footer-slug">
			
			    <div class="wrap">
					<ul class="nav-social" id="social-NYCP">
					    <li class="email"><a href="mailto:info@nycprepared.org" target="_blank"></a></li>
					    <li class="github"><a href="https://github.com/NYCPrepared" target="_blank"></a></li>
					    <li class="twitter"><a href="https://twitter.com/NYCPrepared" target="_blank"></a></li>
					    <li class="facebook"><a href="https://www.facebook.com/nycprepared" target="_blank"></a></li>
					    <li class="rss"><a href="/feed" target="_blank"></a></li>
                    </ul>
				    <h6 class="copyright">Copyleft <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></h6>
			    </div>
			    
			</footer>


		</div> <!-- end #container -->

		<?php wp_footer(); ?>

	</body>

</html>
