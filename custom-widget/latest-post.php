<?php

class comet_latest_post extends WP_Widget{

	public function __construct(){
		parent::__construct('comet-latest-post','Comet Latest Posts',array(
			'description'	=>	'Custom Latest Post Widget by Comet Theme'
		));
	}

	public function widget($ami,$arekta){ ?>

		<?php $posts=new WP_Query(array(
				'post_type'			=>	'post',
				'posts_per_page'	=> $arekta['onkgula']
			));
		?>

		<?php echo $ami['before_widget']; ?>
            <?php echo $ami['before_title']; ?>Latest Posts<?php echo $ami['after_title']; ?>
             <ul class="nav">
             	<?php while($posts->have_posts()) : $posts->the_post(); ?>
                	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?><i class="ti-arrow-right"></i><?php if($shows['date'] == 'show') : ?><span><?php the_time('d M, Y'); ?></span><?php endif;?></a>
                	</li>
            	<?php endwhile; ?>
            </ul>
        <?php echo $ami['after_widget']; ?>

        
    	

	<?php }

	public function form($shows){ ?>

		<p>		
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $shows['title']; ?>">	
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('onkgula'); ?>">Number of posts to show:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id('onkgula'); ?>" name="<?php echo $this->get_field_name('onkgula'); ?>" type="number" step="1" min="1" value="<?php echo $shows['onkgula']; ?>" size="3">
		</p>

		<?php
			if($shows['date'] == 'show'){
				$show="Checked='checked'";
			}else{
				$hide="Checked='checked'";;
			}
		?>

		<p>
			<input value="show" id="<?php echo $this->get_field_id('dateshow'); ?>" type="radio" name="<?php echo $this->get_field_name('date'); ?>" <?php if(isset($show)){echo $show; } ?>>
			<label  for="<?php echo $this->get_field_id('dateshow'); ?>">Show Date</label>
		</p>
		<p>
			<input value="hide" id="<?php echo $this->get_field_id('datehide'); ?>" type="radio" name="<?php echo $this->get_field_name('date'); ?>" <?php if(isset($hide)){echo $hide; } ?>>
			<label  for="<?php echo $this->get_field_id('datehide'); ?>">Hide Date</label>
		</p>

	<?php }

	
}

add_action('widgets_init','latest_post_widget');
function latest_post_widget(){
	register_widget('comet_latest_post');
}
