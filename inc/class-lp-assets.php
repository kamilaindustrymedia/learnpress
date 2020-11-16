<?php
/**
 * Class LP_Assets
 *
 * @author  ThimPress
 * @package LearnPress/Classes
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

class LP_Assets extends LP_Abstract_Assets {
	protected static $_instance;

	/**
	 * Constructor
	 */
	protected function __construct() {
		parent::__construct();

		add_action( 'wp_print_footer_scripts', array( $this, 'show_overlay' ) );
	}

	/**
	 * Get default styles in admin.
	 *
	 * @return mixed
	 */
	protected function _get_styles() {
		return apply_filters(
			'learn-press/frontend-default-styles',
			array(
				'font-awesome-5' => array(
					'url'     => self::url( 'css/vendor/font-awesome-5.min.css' ),
					'screens' => array( 'learnpress' ),
				),
				'lp-bundle'      => array(
					'url'     => self::url( 'css/bundle.min.css' ),
					'screens' => array( 'learnpress' ),
				),
				'learnpress'     => array(
					'url'     => self::url( 'css/learnpress.css' ),
					'screens' => 'learnpress',
				),
			)
		);
	}

	public function _get_script_data() {
		return array(
			'lp-global'       => array(
				'url'         => learn_press_get_current_url(),
				'siteurl'     => site_url(),
				'ajax'        => admin_url( 'admin-ajax.php' ),
				'courses_url' => learn_press_get_page_link( 'courses' ),
				'post_id'     => get_the_ID(),
				'theme'       => get_stylesheet(),
				'localize'    => array(
					'button_ok'     => esc_html__( 'OK', 'learnpress' ),
					'button_cancel' => esc_html__( 'Cancel', 'learnpress' ),
					'button_yes'    => esc_html__( 'Yes', 'learnpress' ),
					'button_no'     => esc_html__( 'No', 'learnpress' ),
				),
				'lp_rest_url' => get_rest_url(),
				'nonce'       => wp_create_nonce( 'wp_rest' ),
			),
			'lp-checkout'     => array(
				'ajaxurl'            => home_url(),
				'user_checkout'      => LP()->checkout()->get_checkout_email(),
				'i18n_processing'    => esc_html__( 'Processing', 'learnpress' ),
				'i18n_redirecting'   => esc_html__( 'Redirecting', 'learnpress' ),
				'i18n_invalid_field' => esc_html__( 'Invalid field', 'learnpress' ),
				'i18n_unknown_error' => esc_html__( 'Unknown error', 'learnpress' ),
				'i18n_place_order'   => esc_html__( 'Place order', 'learnpress' ),
			),
			'lp-profile-user' => array(
				'processing'  => esc_html__( 'Processing', 'learnpress' ),
				'redirecting' => esc_html__( 'Redirecting', 'learnpress' ),
				'avatar_size' => learn_press_get_avatar_thumb_size(),
			),
			'lp-course'       => learn_press_single_course_args(),
			'lp-quiz'         => learn_press_single_quiz_args(),
		);

	}

	public function _get_scripts() {
		$min   = learn_press_is_debug() ? '' : '.min';
		$wp_js = array(
			'jquery',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-hooks',
			'wp-api-fetch',
			'lodash',
		);

		return apply_filters(
			'learn-press/frontend-default-scripts',
			array(
				'lp-modal'            => array(
					'url'  => self::url( 'js/frontend/modal.js' ),
					'deps' => array(
						'jquery',
					),
				),
				// @todo (Nhamdv) Do not use any page, so need check again.
				'lp-plugins-all'      => array(
					'url' => self::url( 'js/vendor/plugins.all' . $min . '.js' ),
				),
				'lp-global'           => array(
					'url'     => self::url( 'js/global' . $min . '.js' ),
					'deps'    => array( 'jquery', 'underscore', 'utils' ),
					'screens' => '*',
				),
				// 'lp-utils'            => array(
				// 'url'     => self::url( 'js/utils' . $min . '.js' ),
				// 'deps'    => array( 'jquery' ),
				// 'screens' => 'learnpress',
				// ),
				'learnpress'          => array(
					'url'  => self::url( 'js/frontend/learnpress' . $min . '.js' ),
					'deps' => array( 'lp-global' ),
				),
				'lp-checkout'         => array(
					'url'     => self::url( 'js/frontend/checkout' . $min . '.js' ),
					'deps'    => array( 'lp-global' ),
					'screens' => learn_press_is_checkout() || learn_press_is_course() && ! learn_press_is_learning_course(),

				),
				'lp-data-controls'    => array(
					'url'  => self::url( 'js/frontend/data-controls' . $min . '.js' ),
					'deps' => array_merge( $wp_js, array( 'lp-global' ) ),
				),
				'lp-config'           => array(
					'url'  => self::url( 'js/frontend/config' . $min . '.js' ),
					'deps' => array_merge( $wp_js, array( 'lp-global' ) ),
				),
				'lp-lesson'           => array(
					'url'  => self::url( 'js/frontend/lesson' . $min . '.js' ),
					'deps' => array_merge( $wp_js, array( 'lp-global' ) ),
				),
				'lp-question-types'   => array(
					'url'  => self::url( 'js/frontend/question-types' . $min . '.js' ),
					'deps' => array_merge( $wp_js, array( 'lp-global' ) ),
				),
				'lp-quiz'             => array(
					'url'  => self::url( 'js/frontend/quiz' . $min . '.js' ),
					'deps' => array_merge( $wp_js, array( 'lp-global', 'lp-question-types', 'lp-modal' ) ),
				),
				'lp-single-course'    => array(
					'url'     => self::url( 'js/frontend/single-course' . $min . '.js' ),
					'deps'    => array(
						'lp-global',
						'lp-config',
						'lp-data-controls',
						'lp-quiz',
						'lp-lesson',
						'lp-custom',
					),
					'screens' => array( 'course' ),
				),
				'lp-courses'          => array(
					'url'     => self::url( 'js/frontend/courses' . $min . '.js' ),
					'deps'    => array( 'lp-global', 'lodash' ),
					'screens' => learn_press_is_courses(),
				),
				'lp-profile-user'     => array(
					'url'     => self::url( 'js/frontend/profile' . $min . '.js' ),
					'deps'    => array(
						'lp-global',
						'plupload',
						'backbone',
						'jquery-ui-slider',
						'jquery-ui-draggable',
						'jquery-touch-punch',
					),
					'screens' => learn_press_is_profile(),
				),
				'lp-become-a-teacher' => array(
					'url'     => self::url( 'js/frontend/become-teacher' . $min . '.js' ),
					'deps'    => array(
						'jquery',
					),
					'screens' => learn_press_is_page( 'become_a_teacher' ),
				),
				'lp-custom'           => array(
					'url'  => self::url( 'js/frontend/custom' . $min . '.js' ),
					'deps' => array(
						'jquery',
					),
				),
			)
		);

	}

	/**
	 * Load assets
	 */
	public function load_scripts() {
		// Register script.
		$this->_register_scripts();

		$scripts = $this->_get_scripts();

		if ( $scripts ) {
			foreach ( $scripts as $handle => $data ) {
				$enqueue = false;

				do_action( 'learn-press/enqueue-script/' . $handle );

				if ( ! empty( $data['screens'] ) ) {
					$enqueue = $this->is_screen( $data['screens'] );
				}

				if ( $enqueue ) {
					wp_enqueue_script( $handle );
				}
			}
		}

		$styles = $this->_get_styles();
		if ( $styles ) {
			foreach ( $styles as $handle => $data ) {
				$enqueue = false;

				do_action( 'learn-press/enqueue-style/' . $handle );

				if ( ! empty( $data['screens'] ) ) {
					$enqueue = $this->is_screen( $data['screens'] );
				}

				if ( $enqueue ) {
					wp_enqueue_style( $handle );
				}
			}
		}

		do_action( 'learn-press/after-enqueue-scripts' );
	}

	/**
	 * Check is currently in a screen required.
	 *
	 * @param array $screens
	 *
	 * @return bool
	 * @since 3.3.0
	 */
	public function is_screen( $screens ) {
		$pages = array(
			'profile',
			'become_a_teacher',
			'term_conditions',
			'checkout',
			'courses',
		);

		$single_post_types                  = array();
		$single_post_types[ LP_COURSE_CPT ] = 'course';
		$is_screen                          = false;

		if ( $screens === true || $screens === '*' ) {
			$is_screen = true;
		} else {
			$screens = is_array( $screens ) ? $screens : array( $screens );
			if ( in_array( 'learnpress', $screens ) ) {
				foreach ( $pages as $page ) {
					if ( $page === 'courses' && learn_press_is_courses() ) {
						$is_screen = true;
						break;
					}

					if ( learn_press_is_page( $page ) ) {
						$is_screen = true;
						break;
					}

					foreach ( $single_post_types as $post_type => $alias ) {
						if ( is_singular( $post_type ) ) {
							$is_screen = true;
							break 2;
						}
					}
				}
			} else {
				foreach ( $pages as $page ) {
					if ( in_array( $page, $screens ) ) {
						if ( $page === 'courses' && learn_press_is_courses() ) {
							$is_screen = true;
							break;
						}

						if ( learn_press_is_page( $page ) ) {
							$is_screen = true;
							break;
						}
					}
				}
			}

			if ( ! $is_screen ) {
				foreach ( $single_post_types as $post_type => $alias ) {
					if ( is_singular( $post_type ) && in_array( $alias, $screens ) ) {
						$is_screen = true;
						break;
					}
				}
			}
		}

		return $is_screen;
	}

	/**
	 * Add lp overlay
	 *
	 * @since 3.2.8
	 * @author tungnx
	 */
	public function show_overlay() {
		$page_current = LP_Page_Controller::page_current();
		if ( ! in_array( $page_current, array( LP_PAGE_COURSE, LP_PAGE_QIZ ) ) ) {
			return;
		}

		echo '<div class="lp-overlay">';
		apply_filters( 'learnpress/modal-dialog', learn_press_get_template( 'global/lp-modal-overlay' ) );
		echo '</div>';
	}

	public static function instance() {
		if ( is_admin() ) {
			return null;
		}

		if ( self::$_instance == null ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}

/**
 * Shortcut function to get instance of LP_Assets
 *
 * @return LP_Assets|null
 */
function learn_press_assets() {
	return LP_Assets::instance();
}

learn_press_assets();

