<?php 

/* Template Name: Discography */ 

if( get_query_var('page') ) {
	$page = get_query_var( 'page' );
  } else {
	$page = 1;
  }

// Variables
$x              = 0;
$releases_per_page  = 12; // How many releases to display on each page
$releases = get_field('release');
$total            = count( $releases );
$pages            = ceil( $total / $releases_per_page );
$min              = ( ( $page * $releases_per_page ) - $releases_per_page ) + 1;
$max              = ( $min + $releases_per_page ) - 1;


get_header(); ?>

  <section id="primary" class="content-area col-sm-12 col-md-12 col-lg-12">
    <main id="main" class="site-main" role="main">
	  <?php // ACF Loop
	    if($releases): ?>
		  <div class="releases-container">
		    <?php foreach( $releases as $i => $row ):
	  		  $cover_art = $row['cover_art']['url'];
	  		  $title = $row['title'];
	  		  $link = $row['link'];
	  		  $description = $row['description'];
	  		  $release_date = $row['release_date'];
  	  		  $x++;
    		  // Ignore this release if $x is lower than $min
    		  if($x < $min) { continue; }
    		  // Stop loop completely if $x is higher than $max
    		  if($x > $max) { break; } ?>                     
    
    		  <div class="release col-sm-6 col-md-4 col-lg-3">
	  			<a href="<?php if($link){ echo $link; }?>">
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
			<?php endforeach; ?>

			<?php if($pages >= 2): 
			// Pagination
			?>
			  <div class="release-pagination">
				<?php 
  				  echo paginate_links( array(
    		  	    'base' => get_permalink() . '%#%' . '/',
    		  		'format' => '?page=%#%',
    		  		'current' => $page,
    		  		'total' => $pages
			  	  )); 
			    ?>
			  </div>
			<?php endif; ?>

<?php else: ?>

  No Releases found.

<?php endif; ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php
get_footer();