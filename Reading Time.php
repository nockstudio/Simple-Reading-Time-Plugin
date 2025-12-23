<?php
/**
 * Plugin Name: Simple Reading Time
 * Plugin URI:  https://github.com/nockstudio/Simple-Reading-Time-Plugin
 * Description: Automatically calculates and displays the estimated reading time for blog posts.
 * Version:     1.0.0
 * Author:      Nockstudio
 * Author URI:  https://github.com/nockstudio/
 * License:     GPL2
 * Text Domain: simple-reading-time
 */

// Security: Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SRT_Reading_Time {

	public function __construct() {
		// 1. Hook for automatic display (optional - currently active)
		add_filter( 'the_content', array( $this, 'add_reading_time_to_content' ) );

		// 2. Register Shortcode [reading_time]
		add_shortcode( 'reading_time', array( $this, 'reading_time_shortcode' ) );
	}

	/**
	 * Method 1: Automatic Injection via Filter
	 */
	public function add_reading_time_to_content( $content ) {
		// Only run on single posts and main query
		if ( ! is_single() || ! is_main_query() ) {
			return $content;
		}

		// Calculate time
		$reading_time_html = $this->get_reading_time_html( $content );

		// Add to the top of content
		return $reading_time_html . $content;
	}

	/**
	 * Method 2: Shortcode Callback
	 * Usage: [reading_time]
	 */
	public function reading_time_shortcode() {
		// Get current post content
		$post = get_post();
		if ( ! $post ) {
			return '';
		}

		// Return the HTML logic
		return $this->get_reading_time_html( $post->post_content );
	}

	/**
	 * Helper: Generate the HTML output
	 * Keeping logic in one place (DRY Principle)
	 */
	private function get_reading_time_html( $content ) {
		$time = $this->calculate_time( $content );

		$html  = '<div class="srt-container" style="display: inline-block; padding: 5px 10px; background: #f1f1f1; border-radius: 5px; margin-bottom: 10px;">';
		$html .= '⏱ ' . esc_html__( 'Reading Time:', 'simple-reading-time' ) . ' <strong>' . $time . ' ' . esc_html__( 'min', 'simple-reading-time' ) . '</strong>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Helper: Math Logic
	 */
	private function calculate_time( $content ) {
		$clean_content = strip_tags( $content );
		$word_count    = str_word_count( $clean_content );
		$time          = ceil( $word_count / 200 );
		return max( 1, $time );
	}
}

new SRT_Reading_Time();
