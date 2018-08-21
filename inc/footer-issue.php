<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ufclas-issuem
 */
?>
</div>
</div>
<div class="footer-wrap row nopadding">
  <div class="container">
    <footer id="default">
      <div class="row">
        <div class="col-sm-4 col-md-3">
          <h3>Resources</h3>
          <ul class="list-unstyled">
            <li><a href=http://news.ufl.edu/ target="_blank">UF News</a></li>
            <li><a href="http://calendar.ufl.edu/" target="_blank">UF Calender</a></li>
            <li><a href="https://my.ufl.edu/ps/signon.html" target="_blank">myUFL</a></li>
            <li><a href="http://www.isis.ufl.edu/" target="_blank">ISIS</a></li>
            <li><a href="https://phonebook.ufl.edu/" target="_blank">Directory</a></li>
          </ul>
        </div>
        <!-- /.col-md-3 -->
        <div class="col-sm-4 col-md-3">
          <h3>Campus</h3>
          <ul class="list-unstyled">
            <li><a href="http://www.ufweather.org" target="_blank">Weather</a></li>
            <li><a href="http://campusmap.ufl.edu/" target="_blank">Campus Map</a></li>
            <li><a href="http://www.virtualtour.ufl.edu" target="_blank">Student Tours</a></li>
            <li><a href="https://catalog.ufl.edu/ugrad/current/Pages/dates-and-deadlines.aspx" target="_blank">Academic Calendar</a></li>
            <li><a href="http://calendar.ufl.edu/" target="_blank">Events</a></li>
          </ul>
        </div>
        <!-- /.col-md-3 -->
        <div class="col-sm-4 col-md-2">
          <h3>Website</h3>
          <ul class="list-unstyled">
            <li><a href="http://clas.ufl.edu/" target="_blank">CLAS</a></li>
            <li><a href="http://www.ufl.edu/websites/" target="_blank">Website Listing</a></li>
            <li><a href="http://accessibility.ufl.edu/" target="_blank">Accessibility</a></li>
            <li><a href="http://privacy.ufl.edu/privacystatement.html" target="_blank">Privacy Policy</a></li>
            <li><a href="http://regulations.ufl.edu/" target="_blank">Regulations</a></li>
          </ul>
        </div>
        <!-- /.col-md-3 -->
        <div class="col-sm-12 col-md-4"> <a href="http://ufl.edu" target="_blank"><img src="<?php echo plugins_url('/images/wordmark.png', __FILE__); ?>" class="wordmark" alt="University of Florida" /></a>
          <p class="social"><a href="https://www.facebook.com/UF.clas/?fref=ts" title="CLAS Facebook" target="_blank"><i class="mdi mdi-facebook"></i></a> <a href="https://twitter.com/uf_clas" target="_blank"><i class="mdi mdi-twitter"></i></a> <a href="http://www.instagram.com/uflorida/" target="_blank"><i class="mdi mdi-instagram"></i></a> <a href="http://www.youtube.com/user/universityofflorida/" target="_blank"><i class="mdi mdi-youtube-play"></i></a></p>
          <p><a href="http://it.clas.ufl.edu/" target="_blank">CLAS IT, Liberal Arts and Sciences</a><br />
            301 Bryant Space Science Center<br />
            (352) 392-1990</p>
        </div>
        <!-- /.col-md-3 --> 
      </div>
      <!-- /.row -->
      <div class="row text-center">
        <?php if ( is_tax() || is_search() ) {
				// Use theme functions if not an article page
				?> <p class="updated">Site Updated <?php ufl_site_last_updated(); ?></p> <?php
			} else {
				?> <p class="updated">Page Updated <?php the_modified_time('F j, Y'); ?></p> <?php
			} 
		?>
      </div>
      <!-- /.row .text-center --> 
    </footer>
    <!-- /footer --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.row --> 
        <?php wp_footer(); ?>
</body>
</html>