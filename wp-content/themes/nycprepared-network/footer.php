			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<section class="global site-meta fourcol first">
						<div class="logo">{NYC:Prepared Logo}</div>
						<?php bloginfo('description'); ?>
						<div class="social links icons">
							<ul class="social-links">
								<li class="facebook"><span class="icon-facebook">FB</span></li>
								<li class="twitter"><span class="icon-twitter">Twitter</span></li>
							</ul>
						</div>
					</section>
					<section class="global links eightcol">
						<ul class="global-links">
							<li class="knowledge">Knowledge</li>
							<li class="data">Data</li>
							<li class="resources">Resources</li>
							<li class="more">More</li>
						</ul>
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
