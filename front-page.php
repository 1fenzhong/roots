<?php get_header();
	
	// [grid column setting] 
	$col_w = 290; // width of grid column
	$gap_w = 35;  // padding + margin-right (15+15+5)
	$max_col = 2; // max column size (style div.x1 ~ xN)
	
	// * additional info *
	// check also "style.css" and "header.php" if you change $col_w and $gap_w.
	// - style.css:
	//   div.x1 ~ xN
	//   div.grid-item
	//   div.single-item
	//   ... and maybe #sidebar2 li.widget.
	// - header.php:
	//   gridDefWidth in javascript code.
	//
	// if you want to show small images in main page always, set $max_col = 1.
	
	// [grid image link setting]
	$flg_img_forcelink = true;   // add/overwrite a link which links to a single post (permalink).
	$flg_img_extract = false;    // in single post page, extract thumbnail link to an original image.
	$flg_obj_fit = 'large-fit';  // none | small-fit | large-fit ... how to fit size of object tag.
	
	// * additional info *
	// if you use image popup utility (like Lightbox) on main index, set $flg_img_forcelink = false;
?>
	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_sidebar_before(); ?>
			<aside id="sidebar-home" class="<?php echo $roots_options['sidebar_class']; ?>" role="complementary">
			<?php roots_sidebar_inside_before(); ?>
			<div class="container">
			    <ul class="widget-ul">
				<?php dynamic_sidebar("Home"); ?>
				<div class="clearfix"></div>
			    </ul>
			</div>
			<?php roots_sidebar_inside_after(); ?>
			</aside><!-- /#sidebar -->
		<?php roots_sidebar_after(); ?>
		<?php roots_main_before(); ?>
			<div id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="container">
					<?php roots_loop_before(); ?>

					<div id="grid-wrapper">
					    <?php
					      $post_query = new WP_Query( array( 'post_type' => array( 'post', 'dream'), 'posts_per_page' => 12 ) );
					      while ( $post_query->have_posts() ) : $post_query->the_post();
					    ?>
					    <?php
					      $GLOBALS['more'] = false;
					      $content = get_the_content('载入全文 &raquo;');
					      $content = apply_filters('the_content', $content);
					      list($col_class, $grid_img) = adjust_grid_image($content, $col_w, $gap_w, $max_col, $flg_img_forcelink, $flg_obj_fit);
					    ?>
					    <article  <?php post_class('grid-item ' . $col_class); ?> id="post-<?php the_ID(); ?>">
						<div class="container">
						<header>
						    <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						</header>
						<?php if ($grid_img) echo '<div class="grid-image">' . $grid_img . '</div>'; ?>
						<div class="post-body">
						    <?php 
						      $content = preg_replace('/<img(?:[^>]+?)>/', '', $content); // remove img tags
						      $content = preg_replace('/<a([^>]+?)><\/a>/', '', $content); // remove empty a tags
						      $content = preg_replace('/<p([^>]*?)><\/p>/', '', $content); // remove empty p tags
						      $content = preg_replace('/<object(.+?)<\/object>/', '', $content); // remove object tags
						      $content = preg_replace('/<video(.+?)<\/video>/s', '', $content); // remove video tags
						      echo $content; 
						    ?>
						</div>
						<footer class="post-meta">
						    <?php $tag = get_the_tags(); if (!$tag) { } else { ?><?php the_tags('标签：', '，'); ?><br /><?php } ?>
						    <?php human_readable_time(); ?> <?php comments_popup_link(); ?>
						</footer>
						</div>
					    </article>
					    <?php endwhile; wp_reset_postdata(); ?>
					</div><!-- /grid-wrapper -->
					<?php roots_loop_after(); ?>
				</div>
			</div><!-- /#main -->
		<?php roots_main_after(); ?>
		</div><!-- /#content -->
	<?php roots_content_after(); ?>
<?php get_footer(); ?>