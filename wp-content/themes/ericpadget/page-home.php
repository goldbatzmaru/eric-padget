<?php 

/* Template Name: Home */ 

// ACF
$calendar_shortcode = get_field('cal_shortcode');
$discography = get_page_by_title( 'Discography' );
$featured = null;
if($discography){
  if($releases = get_field('release', $discography->ID)){
    foreach( $releases as $i => $row ){
      if($row['featured'] != false){
        $featured = $row;
      }
    }
  }
}

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-12">
		<main id="main" class="site-main home" role="main">
          <?php if($featured || $calendar_shortcode): ?>
            <?php if($featured): ?>
              <div class="featured col-sm-12 <?php if($calendar_shortcode): ?>col-md-6 col-lg-6<?php else: ?>col-md-12 col-lg-12<?php endif; ?>">
                <?php 
                  $cover_art = $featured['cover_art']['url'];
                  $title = $featured['title'];
                  $link_url = $featured['link']['url'];
                  $link_target = $featured['link']['target'];
                  $description = $featured['description'];
                  $release_date = $featured['release_date'];
                ?>
	  			  <a href="<?php if($link){ echo $link; }?>" <?php if($link_target):?> target="_blank"<?php endif;?>>
				    <img src="<?php echo $cover_art; ?>"/>
		  		    <div class="release-title">
		    		  <?php echo $title?>
		  		    </div>
	 			  </a>
	 			  <?php if($release_date): ?>
	   			    <div class="release-date">
		 			  <?php echo $release_date; ?>
	   			    </div>
	 			  <?php endif; ?>
	 			  <?php if($description): ?>
	   			    <p>
		 		      <?php echo $description; ?>
	   			    </p>
	 			  <?php endif; ?>
              </div>
            <?php endif; ?>
            <?php if($calendar_shortcode): ?>
              <div class="calendar col-sm-12 <?php if($featured): ?>col-md-6 col-lg-6<?php else: ?>col-md-12 col-lg-12<?php endif; ?>">
                <?php echo do_shortcode($calendar_shortcode); ?>
              </div>
            <?php endif; ?>
         <?php else: ?>
            <div class="home-error">No Featured Release or Calendar.</div>
         <?php endif; ?>
        </main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();