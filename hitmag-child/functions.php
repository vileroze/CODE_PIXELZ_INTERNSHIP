<?php

    //adding styling to admin side metafield
    add_action('admin_head', 'metafield_css');
    function metafield_css() {
        echo 
        '
            <style>
                label{
                    display: block;
                }
                
                input{
                    margin-bottom: 20px;
                }
            </style>
        ';
    }


    //adding custom scripts scripts
    function form_validation_script(){

        wp_enqueue_script('ck-editor-script', "https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js", [], '4.20.1');

        wp_enqueue_script('hitmag-child-script', get_stylesheet_directory_uri() . "/assets/js/customJS.js");
    }
    add_action('wp_enqueue_scripts', 'form_validation_script');



    /*
    * Creating a function to create our CPT
    */
    
    function user_info_post_type() {
  
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'User Info Collection', 'Post Type General Name', 'hitmag-child' ),
            'singular_name'       => _x( 'user Info', 'Post Type Singular Name', 'hitmag-child' ),
            'menu_name'           => __( 'User Info Collection', 'hitmag-child' ),
            'parent_item_colon'   => __( 'Parent User Info', 'hitmag-child' ),
            'all_items'           => __( 'All User Info Collection', 'hitmag-child' ),
            'view_item'           => __( 'View User Info', 'hitmag-child' ),
            'add_new_item'        => __( 'Add New User Info', 'hitmag-child' ),
            'add_new'             => __( 'Add New', 'hitmag-child' ),
            'edit_item'           => __( 'Edit User Info', 'hitmag-child' ),
            'update_item'         => __( 'Update User Info', 'hitmag-child' ),
            'search_items'        => __( 'Search User Info', 'hitmag-child' ),
            'not_found'           => __( 'Not Found', 'hitmag-child' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'hitmag-child' ),
        );
          
        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'userinfo', 'hitmag-child' ),
            'description'         => __( 'Basic user information', 'hitmag-child' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
      
        );
          
        // Registering your Custom Post Type
        register_post_type( 'userinfo', $args );
      
    }
    add_action( 'init', 'user_info_post_type', 0 );



    // create shortcode to display user info form
    function user_info_collection_callback() {  
        ob_start();

        //<input type="text" id="bio" name="bio" >
        echo '
            <h4>User Info</h4>

            <form id="userInfoForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                     
                <label for="full_name">'.__('Full name', 'hitmag').'</label>
                <input type="text" id="full_name" name="full_name" >

                <label for="user_email">'.__('Email', 'hitmag').'</label>
                <input type="text" id="user_email" name="user_email" >

                <label for="bio">'.__('Bio', 'hitmag').'</label>
                <textarea name="bio" id="bio"></textarea>
                
                <label for="location">'.__('Location', 'hitmag').'</label>
                <input type="text" id="location" name="location" >

                <label for="profile_img">'.__('Choose Profile Image', 'hitmag').'</label>
                <input type="file" id="profile_img" name="profile_img" accept=".jpg,.jpeg,.png, image/*" >

                <input type="submit" name="userInfoSubmit" value="Submit">
                
            </form>

        ';

        //intitalize ck editor
        echo "<script> CKEDITOR.replace( 'bio' ); </script>";

        
        //after form submit
        if(isset($_POST['userInfoSubmit'])){ //isset($_POST['submit'])

            $user_full_name = $_POST['full_name'];
            $user_email = $_POST['user_email'];
            $user_bio = $_POST['bio'];
            $user_location = $_POST['location'];

            $serialized_meta_data = serialize([ $user_full_name, $user_email, $user_bio, $user_location ]);

            $post_arr = [
                'ID' => 0,
                'post_title'    => $user_full_name,
                'post_content'    => $user_bio,
                'post_type' => 'userinfo',
                'post_status'   => 'publish',	
                'meta_input'   => [
                    'user_full_name' => $user_full_name,
                    'user_email' => $user_email,
                    'user_bio' => $user_bio,
                    'user_location' => $user_location,
                    'serialized_meta_data' => $serialized_meta_data,
                ],
            ];
            
            //store newly created post id
            $curr_post_id = wp_insert_post( $post_arr, true );

            if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
            if ($_FILES) {
                if ($_FILES['profile_img']['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES['profile_img']['error'];
                }
                $attach_id = media_handle_upload( 'profile_img', get_the_ID() );   
            }
            if ($attach_id > 0){
                //and if you want to set that image as Post  then use:
                update_post_meta($curr_post_id,'user_profile_img',$attach_id);
            }

        }
        return ob_get_clean();
    }
    
    add_shortcode( 'user_info_collection', 'user_info_collection_callback' ); 

    

    //adding parent style and language
    add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
    if( ! function_exists( 'enqueue_parent_styles' ) ){
        function enqueue_parent_styles() {

            wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

            load_theme_textdomain( 'hitmag-child', get_template_directory() . '/languages' );
        }
    }

    if ( ! function_exists( 'adding_child_widgets' ) ){
        
        //creating widgets 
        function adding_child_widgets() {
            $child_content = [
                'widgets' => [
                    'child-sidebar' => [
                        'search',
                        'text_about',
                        'custom_popular_widget' => [ 'hitmag_tabbed_widget', [
                                'nop'	=> 5,
                                'noc'	=> 5
                            ]	 
                        ],
                        'recent-posts'
                    ],
                ]
            ];

            $child_content = apply_filters( 'hitmag_child_content', $child_content );
        }

        //initializing widgets
        function hitmag_child_widgets_init() {
            register_sidebar( 
                [
                    'name'          => esc_html__( 'Child Sidebar', 'hitmag' ),
                    'id'            => 'child-sidebar',
                    'description'   => esc_html__( 'Add widgets here.', 'hitmag' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
                ] 
            );
        }
        add_action( 'widgets_init', 'hitmag_child_widgets_init' );
    }


    //adding the user info metabox
    add_action( 'add_meta_boxes', 'user_info_metabox' );
    //user info metabox field
    function user_info_metabox(){
        add_meta_box("user_info_metabox", "User Information", "user_info_metabox_field", "userinfo", "side");
    }

    //all user metafields
    function user_info_metabox_field(){

        //check value of full_name and display it
        $full_name_data = get_post_meta( get_the_ID(), 'user_full_name' );
        $full_name_val = isset($full_name_data[0]) ? $full_name_data[0] : 'User Full Name';

        echo '<label class="custom-metafield" for="user_full_name_input">'.__('Full Name', 'hitmag').'</label>';
        echo '<input type="text" placeholder="'.esc_html__('Enter user\' full name', 'hitmag').'" name="user_full_name_input" id="user_full_name_input" value="'.$full_name_val.'" >';


        //check value of bio and display it
        $bio_data = get_post_meta( get_the_ID(), 'user_bio' );
        $bio_val = isset($bio_data[0]) ? $bio_data[0] : 'User\' bio';

        echo '<label class="custom-metafield" for="user_bio_input">'.__('Bio').'</label>';
        echo '<input type="text" placeholder="'.esc_html__('Enter user bio', 'hitmag').'" name="user_bio_input" id="user_bio_input" value="'.$bio_val.'" >';


        //check value of location and display it
        $location_data = get_post_meta( get_the_ID(), 'user_location' );
        $location_val = isset($location_data[0]) ? $location_data[0] : 'Nepal';

        echo '<label class="custom-metafield" for="user_location_input">'.__('Location', 'hitmag').'</label>';
        echo '<input type="text" placeholder="'.esc_html__('Enter user location').'" name="user_location_input" id="user_location_input" value="'.$location_val.'" >';


        //check value of email and display it
        $email_data = get_post_meta( get_the_ID(), 'user_email' );
        $email_val = isset($email_data[0]) ? $email_data[0] : 'Dubai';

        echo '<label class="custom-metafield" for="user_email_input">'.__('Email', 'hitmag').'</label>';
        echo '<input type="text" placeholder="'.esc_html__('Enter user email', 'hitmag').'" name="user_email_input" id="user_email_input" value="'.$email_val.'" >';


        //get profile image url and display it
        $profile_image = wp_get_attachment_image_url( get_post_meta(get_the_ID(), 'user_profile_img', true));
        echo '<img src="'.$profile_image.'" alt="user profile image" width="100%" height="auto">';

        echo 
        '
            <form id="userImgUpdate" action="" method="POST" enctype="multipart/form-data">
                <label class="custom-metafield" for="profile_img">'.__('Update Profile Image', 'hitmag').'</label>
                <input type="file" id="metafield_profile_img" name="metafield_profile_img" accept=".jpg,.jpeg,.png, image/*">
            </form>
        ';
        
    }

    //saving the value of the user info metabox field
    add_action('save_post', 'save_detail');
    function save_detail(){

        if( !(isset($_POST["user_full_name_input"]) || isset($_POST["user_bio_input"]) || isset($_POST["user_location_input"]) || isset($_POST["user_email_input"])) ) { return; }

        //updating the user location after saving
        update_post_meta(get_the_ID(), "user_full_name", $_POST["user_full_name_input"]);

        //updating the user location after saving
        update_post_meta(get_the_ID(), "user_bio", $_POST["user_bio_input"]);

        //updating the user location after saving
        update_post_meta(get_the_ID(), "user_location", $_POST["user_location_input"]);

        //updating the user email after saving
        update_post_meta(get_the_ID(), "user_email", $_POST["user_email_input"]);

        //updating user profile picture
        if (!function_exists('wp_generate_attachment_metadata_2')){
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        if ($_FILES) {
            if ($_FILES['metafield_profile_img']['error'] !== UPLOAD_ERR_OK) {
                return "upload error : " . $_FILES['metafield_profile_img']['error'];
            }
            $attach_id = media_handle_upload( 'metafield_profile_img', get_the_ID() );   
        }
        if ($attach_id > 0){
            update_post_meta( get_the_ID(), 'user_profile_img', $attach_id );
        }
    }

?>



