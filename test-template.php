<?php
/*
	template name: test template
*/
 get_header(); ?>
 	<?php
 		$currentpage=get_query_var('paged') ? get_query_var('paged') : 1;
 		$portfolio=new WP_Query(array(
 			'post_type'	=>	'comet-portfolio',
 			'posts_per_page'	=>	1,
 			'paged'	=> $currentpage
 		));

 		while($portfolio->have_posts()) : $portfolio->the_post(); 
 	?>

 	<h3><?php the_title(); ?></h3>

 <?php endwhile;?>
 <?php 
 	
 	//$maxpage=$portfolio->max_num_page;
 	echo paginate_links(array(
 	'current'	=>	$currentpage,
 	'total'		=>	3,
 	'show_all'	=>	true
 )); ?>

<?php get_footer(); ?>