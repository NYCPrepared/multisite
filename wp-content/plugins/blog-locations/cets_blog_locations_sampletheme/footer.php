	<br class="clear" />
 </div> <!-- /#contentArea -->
  <div id="footer">
    <ul>
		<li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
        <!--      <li><a href="#">About FYI</a></li>
      <li><a href="#">Find a County Office</a></li>
      <li><a href="#">UWEX Educator Sign In</a></li>-->
      <?php wp_list_pages('depth=1&title_li='); ?> 
    </ul>
    <ul>
      <?php wp_register(); ?><li> <?php wp_loginout(); ?></li>
      <li><a href="wp-signup.php">Create a new blog</a></li>
      <li><a href="<?php bloginfo('rss2_url'); ?>" class="rss imagereplacement">RSS</a></li>
    </ul>
  </div><!-- / #footer -->
</div><!-- / #wrapper -->
<div id="cesThemeFooter">
	
        <p id="copyright"><a href="http://www.uwex.edu/ces/copyright/">&copy; 2008 Board of Regents of the University of Wisconsin System</a></p>
        <ul id="footerLinks">
            <li><a href="mailto:servicecenter@uwex.uwc.edu">Contact us</a></li>
            <li><a href="http://www.uwex.edu/ces/terms.cfm">Terms of Use</a></li>
            <li><a href="http://www.uwex.edu/ces/privacy.cfm">Privacy Policy</a></li>
			<li><a href="http://wordpress.com/"> Blogging software based on WordPress</a></li>
        	<li><a href="http://akismet.com/">Protected by Akismet</a></li>
        </ul>
        <br class="clear" />
        
</div> <!-- /#cesThemeFooter -->

<?php wp_footer(); ?>

</body>
</html>