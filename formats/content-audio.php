<article class="post-single">
  <div class="post-info">
    <h2><a href="<?php the_permalink(); ?>">Fun With Product Hunt</a></h2>
    <h6 class="upper"><span>By</span><a href="<?php the_permalink(); ?>"> Admin</a><span class="dot"></span><span><?php the_time('d F, Y'); ?></span><span class="dot"></span><?php the_tags(); ?></h6>
  </div>
 
  <div class="post-body">
    <?php the_content(); ?>
    <p><a href="<?php the_permalink(); ?>" class="btn btn-color btn-sm">Read More</a></p>
  </div>
</article>