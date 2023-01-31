<?php
    
    //creating front page panel
    function frontpage_panel(\WP_Customize_Manager $wp_customize){

        $wp_customize->add_panel( 
            'panel_frontpage', array(
                'title' => __('Frontpage Settings', 'vile'),
            )
        );
    }
    add_action('customize_register','frontpage_panel' );



    /**
     * NAV COLOR SECTION
     */

    //navigation color picker
    function vilecustomizable_customizer_navColor(\WP_Customize_Manager $wp_customize){

      
        $wp_customize->add_section( 
            'sec_nav_color', array(
                'title' => __('Navigation Color', 'vile'),
                'description' => 'Set navigation color',
                'panel' => 'panel_frontpage',               
            )
        );
     
        // Add Settings for default color
        $wp_customize->add_setting( 
            'vile_accent_color', array(
                'default' => 'red',
            )
        );

         // Add Settings for default color
        $wp_customize->add_setting( 
            'vile_nav_hover_color', array(
                'default' => 'blue',
            )
        );
     
     
     
        // Add Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vile_accent_color', array(
            'label' => __('Nav Color', 'vile'),
            'section' => 'sec_nav_color',
            'settings' => 'vile_accent_color'
     
            ))
        );

        // Add Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vile_nav_hover_color', array(
            'label' => __('Nav Hover Color', 'vile'),
            'section' => 'sec_nav_color',
            'settings' => 'vile_nav_hover_color'
     
            ))
        );
     
    }
    add_action( 'customize_register', 'vilecustomizable_customizer_navColor' );


    //add the above theme color to elements
    function vilecustomizable_theme_option_css(){
 
        $accent_color = get_theme_mod('vile_accent_color');
        $hover_color = get_theme_mod('vile_nav_hover_color');
     
        if(!empty($accent_color)):
         
        ?>
        <style type="text/css" id="vilecustomizable-theme-option-css">
             
            .navbar-collapse .navbar-nav .menu-item a{
                color: <?php echo $accent_color; ?>
            } 

            .navbar-collapse .navbar-nav .menu-item a:hover{
                color: <?php echo $hover_color; ?>
            }
         
        </style>    
     
        <?php
     
        endif;    
    }
    add_action( 'wp_head', 'vilecustomizable_theme_option_css' );



    /**
     * GRADIENT SECTION
     */

    //gradient color picker
    function vilecustomizable_customizer_gradientColor(\WP_Customize_Manager $wp_customize){
      
        $wp_customize->add_section( 
            'sec_gradient_color', array(
                'title' => __('Gradient Color', 'vile'),
                'description' => 'Set gradient color',
                'panel' => 'panel_frontpage'             
            )
        );
     
        // Add Settings 
        $wp_customize->add_setting( 
            'gradient_start_color', array(
                'default' => '#2937f0',
            )
        );

        // Add Settings 
        $wp_customize->add_setting( 
            'gradient_end_color', array(
                'default' => '#9f1ae2',
            )
        );
     
     
        // Add Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gradient_start_color', array(
            'label' => __('Gradient Start Color', 'vile'),
            'section' => 'sec_gradient_color',
            'settings' => 'gradient_start_color',
     
            ))
        );

        // Add Controls
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gradient_end_color', array(
            'label' => __('Gradient End Color', 'vile'),
            'section' => 'sec_gradient_color',
            'settings' => 'gradient_end_color',
     
            ))
        );

        //quick lookup / change
        $wp_customize->selective_refresh->add_partial(
            'gradient_start_color',
            array(
                'selector' => '.main-gradient',
            )
        );
     
    }
    add_action( 'customize_register', 'vilecustomizable_customizer_gradientColor' );


    //add the above gradient color to elements
    function vilecustomizable_gradient_option_css(){
 
        $start_color = get_theme_mod('gradient_start_color');
        $end_color = get_theme_mod('gradient_end_color');
     
        if(!empty($start_color) && !empty($end_color) ):
         
        ?>
        <style type="text/css" id="vilecustomizable-theme-option-css">
             
            .features-device-mockup .circle .gradient-start-color {
                stop-color: <?php echo $start_color; ?>
            }

            .features-device-mockup .circle .gradient-end-color {
                stop-color: <?php echo $end_color; ?>
            }

            .masthead .masthead-device-mockup .circle .gradient-start-color {
                stop-color: <?php echo $start_color; ?>
            }

            .masthead .masthead-device-mockup .circle .gradient-end-color {
                stop-color: <?php echo $end_color; ?>
            }

            .bg-gradient-primary-to-secondary {
                background: <?php echo "linear-gradient(45deg, ".$start_color.", ".$end_color.") !important;" ?>
            }
         
        </style>    
     
        <?php
     
        endif;    
    }
    add_action( 'wp_head', 'vilecustomizable_gradient_option_css' );



    /**
     * MAIN SECTION
     */

    //main section settings
    function main_section( \WP_Customize_Manager $wp_customize ){
        
        $wp_customize->add_section(
            'sec_main', array(
                'title' => __('Main Section', 'vile'),
                'description' => 'Main app heading section',
                'panel' => 'panel_frontpage'
            )
        );

        //set section visibility
        $wp_customize->add_setting('set_main_visibility');

        $wp_customize->add_control(
            'set_main_visibility', 
            array(
                'label' => __('Hide Section', 'vile'),
                'section' => 'sec_main',
                'type' => 'checkbox',
            )
        );

        //set image position
        $wp_customize->add_setting('set_main_img_pos');

        $wp_customize->add_control(
            'set_main_img_pos', 
            array(
                'label' => __('Set image position', 'vile'),
                'section' => 'sec_main',
                'type' => 'radio',
                'choices' => array(
                    '2' => __( 'Right' ),
                    '4' => __( 'Left' ),
                ),
            )
        );

        //main app title
        $wp_customize->add_setting(
            'set_main_title', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'set_main_title', array(
                'label' => __('App title', 'vile'),
                'description' => 'Enter main app title',
                'section' => 'sec_main',
                'type' => 'text',
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'set_main_title',
            array(
                'selector' => '.main-title',
            )
        );

        //title description
        $wp_customize->add_setting(
            'set_main_desc', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses'
            )
        );

        $wp_customize->add_control(
            'set_main_desc', array(
                'label' => __('App Description', 'vile'),
                'description' => 'Enter main app description',
                'section' => 'sec_main',
                'type' => 'textarea',
            )
        );

        $wp_customize->selective_refresh->add_partial('set_main_desc',array('selector' => '.main-desc'));

        

        //download button 1
        $wp_customize->add_setting('set_dwnld_btn_1');

        $wp_customize->add_control( 
            new \WP_Customize_Image_Control(
                $wp_customize,'set_dwnld_btn_1', 
                array(
                    'label' => 'Donload app Button 1',
                    'section' => 'sec_main',
                )
            ) 
        );


        //download button 1 link
        $wp_customize->add_setting('set_dwnld_btn_1_link', 
            array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            )
        );

        $wp_customize->add_control( 
            'set_dwnld_btn_1_link', 
            array(
                'label' => __('Download app Button 1 link', 'vile'),
                'type' => 'url',
                'section' => 'sec_main',
            )
        );

        //add pen icon that takes you to the specific field
        $wp_customize->selective_refresh->add_partial('set_dwnld_btn_1_link',array('selector' => '.main-dwnld-1'));

        //download button 2
        $wp_customize->add_setting('set_dwnld_btn_2', 
            array(
                'sanitize_callback' => 'esc_url_raw' //cleans URL from all invalid characters
            )
        );

        $wp_customize->add_control( 
            new \WP_Customize_Image_Control(
                $wp_customize,'set_dwnld_btn_2', 
                array(
                    'label' => 'Donload app Button 2',
                    'section' => 'sec_main',
                )
            ) 
        );

        //add pen icon that takes you to the specific field
        $wp_customize->selective_refresh->add_partial('set_dwnld_btn_2_link',array('selector' => '.main-dwnld-2'));

        //download button 1 link
        $wp_customize->add_setting('set_dwnld_btn_2_link');

        $wp_customize->add_control( 
            'set_dwnld_btn_2_link', 
            array(
                'label' => __('Download app Button 2 link', 'vile'),
                'type' => 'url',
                'section' => 'sec_main',
            )
        );

        //app demo video
        $wp_customize->add_setting(
            'set_app_demo_vid',
            array(
            'type' => 'theme_mod',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Media_Control(
                $wp_customize,
                'set_app_demo_vid',
                array(
                    'label' => __('App demo video', 'vile'),
                    'section' => 'sec_main',
                    'mime_type' => 'video',
                    // Required. Can be image, audio, video, application, text
                    'button_labels' => array(
                        // Optional
                        'select' => __('Select File'),
                        'change' => __('Change File'),
                        'default' => __('Default'),
                        'remove' => __('Remove'),
                        'placeholder' => __('No file selected'),
                        'frame_title' => __('Select File'),
                        'frame_button' => __('Choose File'),
                    )
                )
            )
        );

        $wp_customize->selective_refresh->add_partial('set_app_demo_vid',array('selector' => '.main-app-demo'));


        //phone border
        $wp_customize->add_setting('set_phone_border');

        $wp_customize->add_control( 
            new \WP_Customize_Image_Control(
                $wp_customize,'set_phone_border', 
                array(
                    'label' => __('Phone Border', 'vile'),
                    'section' => 'sec_main',
                )
            ) 
        );

        $wp_customize->selective_refresh->add_partial('set_phone_border',array('selector' => '.main-phone-border'));

    }
    add_action('customize_register', 'main_section');



    //add the phone border around the app demo video
    function vilecustomizable_phone_border(){
 
        $phone_border = get_theme_mod('set_phone_border');
     
        if(!empty($phone_border)):
         
        ?>
        <style type="text/css" id="vilecustomizable-theme-option-css">
             
            .device[data-device=iPhoneX][data-orientation=portrait][data-color=black]::after {
                content: "";
                background-image: url("<?php echo $phone_border ?>");
            }
         
        </style>
     
        <?php
     
        endif;    
    }
    add_action( 'wp_head', 'vilecustomizable_phone_border' );




    
    /**
     * INFORMATION SECTION
     */

    //info section
    function info_section( \WP_Customize_Manager $wp_customize ){
        
        $wp_customize->add_section(
            'sec_info', array(
                'title' => __('Information Section', 'vile'),
                'description' => 'Displays information about app',
                'panel' => 'panel_frontpage'
            )
        );

        //info repeater
        $wp_customize->add_setting( 'customizer_repeater_example');

        $wp_customize->add_control( 
            new Customizer_Repeater( $wp_customize, 'customizer_repeater_example', 
                array(
                    'label'   => 'Add New Section',
                    'section' => 'sec_info',
                    'priority' => 1,
                    'customizer_repeater_title_control' => true,
                    'customizer_repeater_subtitle_control' => true,
                    'customizer_repeater_image_control' => true,
                    'customizer_repeater_icon_control' => true,
                    'customizer_repeater_img_pos_control' => true,
                ) 
            ) 
        );


        //set section visibility
        $wp_customize->add_setting('set_info_visibility');

        $wp_customize->add_control(
            'set_info_visibility', 
            array(
                'label' => __('Hide Section', 'vile'),
                'section' => 'sec_info',
                'type' => 'checkbox',
            )
        );

        //set image position
        $wp_customize->add_setting('set_info_img_pos');

        $wp_customize->add_control(
            'set_info_img_pos', 
            array(
                'label' => __('Set image position', 'vile'),
                'section' => 'sec_info',
                'type' => 'radio',
                'choices' => array(
                    '2' => __( 'Right' ),
                    '4' => __( 'Left' ),
                ),
            )
        );

        // app info title
        $wp_customize->add_setting(
            'set_info_title', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'set_info_title', array(
                'label' => __('App title', 'vile'),
                'description' => __('Enter info title', 'vile'),
                'section' => 'sec_info',
                'type' => 'text',
            )
        );

        //info description
        $wp_customize->add_setting(
            'set_info_desc', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'set_info_desc', array(
                'label' => __('App Description', 'vile'),
                'description' => 'Enter info description',
                'section' => 'sec_info',
                'type' => 'text',
            )
        );

        //section image
        $wp_customize->add_setting('set_info_sec_img');

        $wp_customize->add_control(
            new \WP_Customize_Image_Control(
                $wp_customize,'set_info_sec_img', 
                array(
                    'label' => __('Section Image', 'vile'),
                    'section' => 'sec_info',
                )
            ) 
        );
    }
    add_action('customize_register', 'info_section');


    /**
     * COPYRIGHT SECTION
     */

    //copyright notice settings
    function copyright_panel( \WP_Customize_Manager $wp_customize ){
        
        $wp_customize->add_section(
            'sec_copyright', array(
                'title' => __('Copyright Settings', 'vile'),
                'description' => __('Copyright Section', 'vile'),
                'panel' => 'panel_frontpage'
            )
        );

        $wp_customize->add_setting(
            'set_copyright', array(
                'type' => 'theme_mod',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'set_copyright', array(
                'label' => __('Copyright', 'vile'),
                'description' => __('Please type your copyright info here', 'vile'),
                'section' => 'sec_copyright',
                'type' => 'text',
            )
        );

    }
    add_action('customize_register', 'copyright_panel');


?>