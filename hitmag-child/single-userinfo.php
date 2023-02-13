<?php

get_header(); 

do_action( 'hitmag_before_content' ); 

$meta_data_arr = unserialize(get_post_meta( get_the_ID(), 'serialized_meta_data' )[0]);

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="box">
                <div class="user-avatar">
                    <img src="<?php echo wp_get_attachment_image_url( get_post_meta(get_the_ID(), 'user_profile_img', true), 'hitmag-grid'); ?>" alt="user profile image">
                </div>
                <div class="user-info">
                    <div class="user-name">
                        @<?php echo $meta_data_arr[0]; ?>
                    </div>
                    <div class="user-bio">
                        <?php echo $meta_data_arr[2]; ?>
                    </div>
                    <div class="user-location">
                        🏠 <?php echo $meta_data_arr[3]; ?>
                    </div>
                    <div class="user-email">
                        📨 <?php echo $meta_data_arr[1]; ?>
                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_sidebar();

do_action( 'hitmag_after_content' );

get_footer();

?>