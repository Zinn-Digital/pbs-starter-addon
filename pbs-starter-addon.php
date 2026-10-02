<?php
/**
 * Plugin Name:       PBS Starter Add-on
 * Plugin URI:        https://github.com/Zinn-Digital/pbs-starter-addon
 * Description:       A complete, working example of a Page Builder Sandwich add-on: a block, a style control, a dynamic data source, a display condition and a form action, built against the published API. Copy it to start your own.
 * Version:           1.0.0
 * Requires at least: 6.8
 * Requires PHP:      8.2
 * Author:            Neil Lock — CEO, Zinn Digital® Ltd
 * Author URI:        https://zinndigital.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pbs-starter-addon
 *
 * @package PbsStarterAddon
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	static function (): void {
		// The builder is not active (or older than 6.32): this add-on does nothing. (No "Requires
		// Plugins" header: Page Builder Sandwich Pro installs under another folder name.)
		if ( ! function_exists( 'pbsw_register_block' ) ) {
			return;
		}
		$plugin = 'PBS Starter Add-on';

		// 1. A block (its CSS loads only on pages that use it: block.json "style").
		pbsw_register_block( __DIR__ . '/build/notice', array( 'plugin' => $plugin ) );

		// 2. A style control in every block's Style panel, compiled to CSS by the builder.
		pbsw_register_style_control(
			'pbs-starter/text-wrap',
			array(
				'label'    => __( 'Text wrapping', 'pbs-starter-addon' ),
				'kind'     => 'choice',
				'property' => 'text-wrap',
				'choices'  => array( 'wrap', 'balance', 'pretty' ),
				'options'  => array(
					'wrap'    => __( 'Normal', 'pbs-starter-addon' ),
					'balance' => __( 'Balanced', 'pbs-starter-addon' ),
					'pretty'  => __( 'No orphans', 'pbs-starter-addon' ),
				),
				'group'    => 'typography',
				'plugin'   => $plugin,
			)
		);

		// 3. A dynamic data source: any heading, paragraph or button can show it (Pro).
		pbsw_register_dynamic_source(
			'pbs-starter/greeting',
			array(
				'label'    => __( 'Greeting', 'pbs-starter-addon' ),
				'fields'   => array(
					'hello'   => __( 'Hello and the site name', 'pbs-starter-addon' ),
					'weekday' => __( 'Today\'s weekday', 'pbs-starter-addon' ),
				),
				'callback' => static function ( array $args, array $context ): ?string {
					unset( $context );
					if ( 'weekday' === ( $args['field'] ?? '' ) ) {
						return wp_date( 'l' );
					}
					/* translators: %s: the site's name. */
					return sprintf( __( 'Hello from %s', 'pbs-starter-addon' ), get_bloginfo( 'name' ) );
				},
				'plugin'   => $plugin,
			)
		);

		// 4. A display condition: "on these weekdays" (the author types e.g. "sat,sun") (Pro).
		pbsw_register_condition(
			'pbs-starter/weekday',
			array(
				'label'     => __( 'Weekday (mon,tue,…)', 'pbs-starter-addon' ),
				'callback'  => static function ( array $rule ): bool {
					$days = array_map( 'trim', explode( ',', strtolower( (string) ( $rule['value'] ?? '' ) ) ) );
					return in_array( strtolower( wp_date( 'D' ) ), $days, true );
				},
				'cacheable' => false,
				'plugin'    => $plugin,
			)
		);

		// 5. A form action: keep the last 20 submissions in an option (Pro form builder).
		pbsw_register_form_action(
			'pbs-starter/log',
			array(
				'label'    => __( 'Keep a log of submissions (starter add-on)', 'pbs-starter-addon' ),
				'input'    => __( 'Log name', 'pbs-starter-addon' ),
				'callback' => static function ( array $submission, array $settings ) {
					$log   = (array) get_option( 'pbs_starter_log', array() );
					$log[] = array(
						'name' => sanitize_text_field( (string) ( $settings['value'] ?? 'default' ) ),
						'rows' => (array) ( $submission['rows'] ?? array() ),
						'time' => time(),
					);
					update_option( 'pbs_starter_log', array_slice( $log, -20 ), false );
					return true;
				},
				'plugin'   => $plugin,
			)
		);
	}
);

// 6. A panel on the builder's own admin screen (typed with @zinn-digital/pbs-types).
add_action(
	'pbsw_admin_enqueue',
	static function ( string $after ): void {
		$asset = require __DIR__ . '/build/admin.asset.php';
		wp_enqueue_script( 'pbs-starter-admin', plugins_url( 'build/admin.js', __FILE__ ), array_merge( $asset['dependencies'], array( $after ) ), $asset['version'], true );
		wp_set_script_translations( 'pbs-starter-admin', 'pbs-starter-addon' );
	}
);
