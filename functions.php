<?php

/**
 * Additional functionality for the theme.
 * 
 * Before adding check if it should be a plugin.
 */ 

// disallow file edit in admin
add_action( 'init', function() {
    if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
        define( 'DISALLOW_FILE_EDIT', true );
    }
});

if ( ! function_exists( 'tsv1913_editor_style' ) ) {
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since tsv1913 1.2
	 */
	function tsv1913_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
}
add_action( 'after_setup_theme', 'tsv1913_editor_style' );

if ( ! function_exists( 'tsv1913_enqueue_styles' ) ) {
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since tsv1913 1.0
	 */
	function tsv1913_enqueue_styles() {
		wp_enqueue_style(
			'tsv1913-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'tsv1913_enqueue_styles' );

if ( ! function_exists( 'tsv1913_add_default_avatar_option' ) ) {
	/**
	 * Add own profile image avatar option.
	 *
	 * @since tsv1913 1.1
	 */
	function tsv1913_add_default_avatar_option( $avatars ) {
		$url = get_parent_theme_file_uri() . '/assets/images/avatar-default.png';
		$avatars[ $url ] = 'TSV Avatar';

		return $avatars;
	}
}
add_filter( 'avatar_defaults', 'tsv1913_add_default_avatar_option' );

if ( ! function_exists( 'tsv1913_fix_default_avatar_url' ) ) {
	/**
	 * Fix theme default avatar url since it gets some gravatar prefix.
	 *
	 * @since tsv1913 1.1
	 *
	 * @return void
	 */
	function tsv1913_fix_default_avatar_url( $args ) {

		if ( $args['found_avatar'] === false ) {
			$args['url'] = $args['default'];
		}

		return $args;
	}
}
add_filter( 'get_avatar_data', 'tsv1913_fix_default_avatar_url');

/**
 * Get form block recipients from theme mod and return as array.
 * @param array $recipients Die Empfänger
 * @param int $form_id Die Formular-ID
 * @param array $fields Die überprüften Felder
 * @param array $files Die überprüften Dateien
 * @since tsv1913 1.2
 *
 * @return array
 */
function tsv1913_form_block_recipients( array $recipients, int $form_id, array $fields, array $files ): array {
	return [ 'kontakt@tsv1913.de' ];
}
add_filter( 'form_block_recipients', 'tsv1913_form_block_recipients' );