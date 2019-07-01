<?php

function attranctions_do_layout( $atts ) {
    $args = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    ob_start();

    echo 'hello world';

    return ob_get_clean();
}
add_shortcode( 'attractions', 'attranctions_do_layout' );