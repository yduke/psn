<?php $post_id=get_the_ID();?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<header class="entry-header">
<div class="my-5 text-center">
            <?php if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( $post_id, 'full' ) . '</div>';
            endif; ?>
        <h2 class="display-5 fw-bold"><?php the_title(); ?></h2>
        <div class="entry-meta">
                <?php
                echo
                __('Last Played on','psn').' '
                .esc_attr( get_the_date() . ' - ' . get_the_time() )
                .' '.__('by','psn').' '
                .get_option('stm_name');
                ?>
        </div><!-- /.entry-meta -->

    </div>

</header><!-- /.entry-header -->
<div class="entry-content">
        <table class="table table-striped table-sm">
          <tbody>
            <tr>
              <td><?php _e('Name','psn');?></td>
              <td><?php the_title();?></td>
            </tr>
            <tr>
              <td><?php _e('Platform','psn');?></td>
              <td>Steam</td>
            </tr>

            <tr>
              <td><?php _e('Play Duration','psn');?></td>
              <td><?php 
              $playtime = get_post_meta($post_id,'playtime',true);
              $hours = intdiv($playtime, 60).__('h', 'psn'). ($playtime % 60).__('m', 'psn');
              echo $hours;
              ?></td>
            </tr>
          </tbody>
        </table>
        <?php if(get_the_content() !=''){ ?>
        <h3><?php _e('Description','psn')?></h3>
        <p class="lead mb-4"><?php
            the_content();
            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'psn' ) . '</span>', 'after' => '</div>' ) );
            ?></p>
            <?php } ?>
</div><!-- /.entry-content -->

<?php
    edit_post_link( __( 'Edit', 'psn' ), '<span class="edit-link">', '</span>' );
?>


</article><!-- /#post-<?php the_ID(); ?> -->