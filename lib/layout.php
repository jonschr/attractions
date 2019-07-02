<?php

function attractions_do_layout( $atts ) {
    $args = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    ob_start();

    echo '<div class="attractions-wrap">';

    ////////////////////////
    // JAVASCRIPT FILTERS //
    ////////////////////////

    ?>
    <script>
    jQuery(document).ready(function( $ ) {

        // Show everything once the page is fully loaded
        $( '.type-attractions' ).addClass( 'active' );
	
        $( 'ul.attractions-filters a' ).click( function( e ) {
            e.preventDefault();
            term = $( this ).attr( 'data-term' );
            // console.log( term );

            $( '.type-attractions' ).removeClass( 'active' );
            $( '.attractiontype-' + term ).addClass( 'active' );
        });
        
    });
    </script>
    <?php


    //////////////////////////
    // OUTPUT EACH CATEGORY //
    //////////////////////////

    $terms = get_terms( 'attractiontype', array(
        'hide_empty' => true,
    ) );

    $terms = get_terms( array(
        'taxonomy' => 'attractiontype',
        'hide_empty' => true,
    ) );

    if ( $terms ) {

        echo '<ul class="attractions-filters">';

        foreach( $terms as $term ) {
            $slug = $term->slug;
            $name = $term->name;
            printf( '<li class=""><a class="" data-term="%s" href="#">%s</a></li>', $slug, $name );
        }
        
        echo '</ul>';
    }


    ////////////////////////////
    // OUTPUT EACH ATTRACTION //
    ////////////////////////////

    $args = array(
        'post_type' => 'attractions',
        'posts_per_page' => '-1'
    );

    // The Query
    $custom_query = new WP_Query( $args );

    // The Loop
    if ( $custom_query->have_posts() ) {

        echo '<div class="attractions-items">';

        while ( $custom_query->have_posts() ) {
            
            $custom_query->the_post();

            printf( '<div class="%s">', implode( get_post_class(), ' ' ) );

                $title = get_the_title();
                $address = get_post_meta( get_the_ID(), 'address' , true );
                $customurl = get_post_meta( get_the_ID(), 'customurl' , true );

                //* No link (default)
                $link = null;

                //* If we just have an address
                if ( $address && !$customurl )
                    $link = 'https://www.google.com/search?q=' . urlencode( $address );

                //* If we have a custom URL
                if ( $customurl )
                    $link = $customurl;

                if ( $link )
                    printf('<a target="_blank" class="overlay" href="%s"></a>', $link );

                printf( '<div class="featured-image" style="background-image:url( %s )"></div>', get_the_post_thumbnail_url( get_the_ID(), 'medium' ) );

                if ( $title )
                    printf( '<h3>%s</h3>', $title );

                if ( $address )
                printf( '<p class="address">%s</p>', $address );
            

            echo '</div>';

        }

        echo '</div>';
        
        // Restore postdata
        wp_reset_postdata();

    }

    echo '</div>'; // .attractions-wrap

    return ob_get_clean();
}
add_shortcode( 'attractions', 'attractions_do_layout' );