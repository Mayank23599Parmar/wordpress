
<footer class="site-footer">
      <div class="site-footer__inner container container--narrow">
        <div class="group">
          <div class="site-footer__col-one">
            <h1 class="school-logo-text school-logo-text--alt-color">
              <a href="<?php echo site_url()?>"><strong>Fictional</strong> University</a>
            </h1>
            <p><a class="site-footer__link" href="#">555.555.5555</a></p>
          </div>

          <div class="site-footer__col-two-three-group">
            <div class="site-footer__col-two">
              <h3 class="headline headline--small">Explore</h3>
              <nav class="nav-list">
                <ul>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Programs</a></li>
                  <li><a href="#">Events</a></li>
                  <li><a href="#">Campuses</a></li>
                </ul>
              </nav>
            </div>

            <div class="site-footer__col-three">
              <h3 class="headline headline--small">Learn</h3>
              <nav class="nav-list">
                <ul>
                  <li><a href="#">Legal</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Careers</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="site-footer__col-four">
            <h3 class="headline headline--small">Connect With Us</h3>
            <nav>
              <ul class="min-list social-icons-list group">
                <li>
                  <a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </footer>
    <?php wp_footer()  ?>
  </body>
</html>
<form method="post">
    <input type="text" class="process_custom_images" id="process_custom_images" name="selected_logo" value="" placeholder="http://">
    <button class="set_custom_logo button" style="vertical-align: middle;">Select Logo</button>
</form>

<script>
//“Add Media” button
jQuery(document).ready(function() {
    var $ = jQuery;
    if ($('.set_custom_logo').length > 0) {
        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $(document).on('click', '.set_custom_logo', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.prev();
                wp.media.editor.send.attachment = function(props, attachment) {
                    id.val(attachment.url);
                };
                wp.media.editor.open(button);
                return false;
            });
        }
    }
});
</script>