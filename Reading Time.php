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

/**
 * Main Class for Reading Time Plugin
 * Using a class structure avoids function name collisions.
 */
class SRT_Reading_Time {

	/**
	 * Constructor to initialize hooks
	 */
	public function __construct() {
		// Hook into 'the_content' to add reading time before the post content
		add_filter( 'the_content', array( $this, 'add_reading_time_to_content' ) );
	}

	/**
	 * Calculate and prepend reading time
	 *
	 * @param string $content The post content.
	 * @return string The modified content.
	 */
	public function add_reading_time_to_content( $content ) {
		// Only show on single posts (not on homepage or archive pages) and main query
		if ( ! is_single() || ! is_main_query() ) {
			return $content;
		}

		// Calculate reading time
		$reading_time = $this->calculate_time( $content );

		// HTML for the reading time label
		// We use esc_html__ for security and translation support
		$html  = '<div class="srt-container" style="margin-bottom: 15px; color: #555; font-weight: bold;">';
		$html .= '⏱ ' . esc_html__( 'Reading Time:', 'simple-reading-time' ) . ' ' . $reading_time . ' ' . esc_html__( 'min', 'simple-reading-time' );
		$html .= '</div>';

		// Prepend to content
		return $html . $content;
	}

	/**
	 * Logic to count words and estimate time
	 * Average reading speed is ~200 words per minute.
	 *
	 * @param string $content
	 * @return int
	 */
	private function calculate_time( $content ) {
		// Strip HTML tags to count only text
		$clean_content = strip_tags( $content );
		
		// Count words
		$word_count = str_word_count( $clean_content );
		
		// Calculate time (Words / 200) and round up (ceil)
		$time = ceil( $word_count / 200 );

		// Ensure at least 1 minute is shown
		return max( 1, $time );
	}
}

// Initialize the plugin
new SRT_Reading_Time();
