<aside class="read-next">
    <?php
    $next_post = get_next_post(true);
    if ( $next_post ): ?>
    <a class="read-next-story <?php if ( !has_post_thumbnail( $next_post->ID ) ) echo "no-cover"; ?>" <?php if ( has_post_thumbnail( $next_post->ID ) ) :  ?>style="background-image: url(<?php echo get_the_post_thumbnail_url( $next_post->ID ); ?>)"<?php endif; ?> href="<?php echo get_permalink( $next_post->ID ); ?>">
        <section class="post">
            <h2><?php echo $next_post->post_title; ?></h2>
            <p><?php echo get_the_excerpt( $next_post->ID ); ?>&hellip;</p>
        </section>
    </a>
    <?php endif; ?>
    
    <?php
    $prev_post = get_previous_post();
    if ( $prev_post ): ?>
    <a class="read-next-story prev <?php if ( !has_post_thumbnail( $prev_post->ID ) ) echo "no-cover"; ?>" <?php if ( has_post_thumbnail( $prev_post->ID ) ) :  ?>style="background-image: url(<?php echo get_the_post_thumbnail_url( $prev_post->ID ); ?>)"<?php endif; ?> href="<?php echo get_permalink( $prev_post->ID ); ?>">
        <section class="post">
            <h2><?php echo $prev_post->post_title; ?></h2>
            <p><?php echo get_the_excerpt( $prev_post->ID ); ?>&hellip;</p>
        </section>
    </a>
    <?php endif; ?>
    
</aside>