			<footer class="footer" role="contentinfo">
				<div class="inner-footer">

					<section class="global site-meta first">
						<a href="http://nycprepared.org"><img src="/multisite/wp-content/themes/community/library/images/NYCPbadgeKO.png" alt="NYCPbadgeKO" width="140" height="140" /></a>
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

           <!-- TODO: USE GROUP'S INFO -->
			<footer class="footer-slug">
			    <div class="inner-footer">
			    
					<ul class="nav-social" id="social-group">
					    <li class="email"><a href="mailto:info@[GROUP]" target="_blank"></a></li>
					    <li class="github"><a href="https://github.com/GROUP" target="_blank"></a></li>
					    <li class="twitter"><a href="https://twitter.com/GROUP" target="_blank"></a></li>
					    <li class="facebook"><a href="https://www.facebook.com/GROUP" target="_blank"></a></li>
					    <li class="rss"><a href="/feed" target="_blank"></a></li>
                    </ul>
				    <h6 class="copyright">Copyleft <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></h6>
				    
			    </div>
			</footer>


		</div> <!-- end #container -->

		<?php wp_footer(); ?>

	</body>

</html>
