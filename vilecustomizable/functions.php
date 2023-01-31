<?php

	//adds dynamic title tag support
	add_theme_support('title-tag');
	//adds dynamic custom logo
	add_theme_support('custom-logo');
	//adds thumbnail pictures to blog items
	add_theme_support('post-thumbnails');

	//menus
	function vilecustomizable_menus(){
		$locations = array(
			'primary' => "Primary Navigation Menu",
			'secondary' => "Secondary Footer Menu"
		);

		register_nav_menus($locations);
	}
	//menu action
	add_action('init', 'vilecustomizable_menus');



	//enquing styles
	function vilecustomizable_register_styles(){
		$version = wp_get_theme()->get('Version');

		//enquing custom styles after bootstrap styles
		wp_enqueue_style('vilecustomizable-font-newreader', "https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap", array(), '1.0.0', 'all');
		wp_enqueue_style('vilecustomizable-font-mulish', "https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap", array(), '1.0.0', 'all');
		wp_enqueue_style('vilecustomizable-font-kanit', "https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap", array(), '1.0.0', 'all');
		wp_enqueue_style('vilecustomizable-style', get_template_directory_uri()."/assets/css/style.css", array(), $version, 'all');
		
	}
	//executing vile_register_styles()
	add_action('wp_enqueue_scripts', 'vilecustomizable_register_styles');


	//enquing scripts
	function vilecustomizable_register_scripts(){
		$version = wp_get_theme()->get('Version'); 

		//enqueueing scripts
		wp_enqueue_script('vilecustomizable-bootstrapjs', "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", array(), '5.1.3', true);
		wp_enqueue_script('vilecustomizable-customjs', get_template_directory_uri()."/assets/js/main.js", array(), $version, true);
		wp_enqueue_script('vilecustomizable-sbforms', "https://cdn.startbootstrap.com/sb-forms-latest.js", array(), '0.4.1', true);
	}
	//executing vilecustomizable_register_scripts()
	add_action('wp_enqueue_scripts', 'vilecustomizable_register_scripts');


	require get_template_directory() . '/customizer-repeater/functions.php';
	require_once get_template_directory().'/inc/customizer.php';