<?php
/*
 Plugin Name:   Smooth Scroller
 Plugin URI:    https://alephmedia.my
 Description:   Smooth scroller by Aleph Media.
 Author:        Aleph Media
 Author URI:    https://alephmedia.my
 Version:       0.2
 Update URI:    false

 GitHub Plugin URI:  https://github.com/alandloh/smooth-scroller
 GitHub Branch:      main
*/


wp_enqueue_scripts(

    // The core GSAP library
    wp_enqueue_script( 
        'gsap-js', 
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js', 
        array(), 
        '3.13.0', 
        array(
            'strategy' => 'defer',
            'in_footer' => true
        ) 
    );
    
    // ScrollTrigger - with gsap.js passed as a dependency
    wp_enqueue_script( 
        'gsap-st', 
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js', 
        array('gsap-js'), 
        '3.13.0', 
        array(
            'strategy' => 'defer',
            'in_footer' => true
        ) 
    );

    wp_enqueue_script(
        'gsap-ss',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollSmoother.min.js',
        array('gsap-js'),
        '3.13.0', 
        array(
            'strategy' => 'defer',
            'in_footer' => true
        ) 
    );
    
    // Your animation code file - with gsap.js passed as a dependency
    wp_enqueue_script( 
        'gsap-js2', 
        plugin_dir_url(__FILE__) . 'js/app.js',
        array('gsap-js'), 
        null, 
        array(
            'strategy' => 'defer',
            'in_footer' => true
        ) 
    );

);
