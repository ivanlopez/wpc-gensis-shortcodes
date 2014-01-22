<?php  

function button( $atts, $content = null ) { 
  
    extract( shortcode_atts( array( 
        'url' => '',
        'type' => 'btn-default'
        ), $atts ) ); 
  
    return '<a href="'. $url .'" class="button '. $type  .'" title="'.do_shortcode( $content ).'">' . do_shortcode( $content ) . '</a>'; 
} 

add_shortcode('button', 'button'); 

function notice( $atts, $content = null ) { 
    return '<div class="notice-box">' . do_shortcode( $content ) . '</div>'; 
} 

add_shortcode('notice-box', 'notice'); 

