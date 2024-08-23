<?php
/**
 * 
 * Template Name: Front Page Tamplate
 * The template for displaying all pages.
 * This is the template that displays front page of the website.
 *.
 *
 *
 * @package Astra Child Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>


	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_content_page_loop(); ?>
        

		<?php astra_primary_content_bottom(); ?>

	</div>


<?php get_footer(); ?>
