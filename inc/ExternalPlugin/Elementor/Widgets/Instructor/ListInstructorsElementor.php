<?php
/**
 * Class SingleInstructorElementor
 *
 * @sicne 4.2.3
 * @version 1.0.0
 */

namespace LearnPress\ExternalPlugin\Elementor\Widgets\Instructor;

use Exception;
use LearnPress\ExternalPlugin\Elementor\LPElementorWidgetBase;
use LearnPress\Helpers\Config;
use LearnPress\TemplateHooks\Instructor\SingleInstructorTemplate;
use WP_User_Query;

class ListInstructorsElementor extends LPElementorWidgetBase {
	public function __construct( $data = [], $args = null ) {
		$this->title    = esc_html__( 'List Instructors', 'learnpress' );
		$this->name     = 'list_instructors';
		$this->keywords = [ 'list instructor', 'instructor', 'list' ];
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->controls = Config::instance()->get( 'list-instructors', 'elementor/instructor' );
		parent::register_controls();
	}

	protected function render() {
		try {
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['item_layouts'] ) ) {
				return;
			}

			// Query
			$args = [
				'number'   => $settings['limit'] ?? 5,
				'role__in' => [ 'lp_teacher', 'administrator' ],
				'fields'   => 'ID',
			];

			switch ( $settings['order_by'] ) {
				case 'desc_name':
					$args['orderby'] = 'display_name';
					$args['order']   = 'desc';
					break;
				case 'name':
				default:
					$args['orderby'] = 'display_name';
					$args['order']   = 'asc';
					break;
			}

			$query = new WP_User_Query( $args );

			$instructors = $query->get_results();
			// End Query

			$item_layout = $settings['item_layouts'][0];

			// Show list instructors
			$singleInstructorTemplate = SingleInstructorTemplate::instance();
			echo '<ul class="list-instructors">';
			foreach ( $instructors as $instructor_id ) {
				$instructor = learn_press_get_user( $instructor_id );
				?>
				<li class="item-instructor">
					<?php echo $singleInstructorTemplate->render_data( $instructor, html_entity_decode( $item_layout['layout_html'] ) ); ?>
				</li>
				<?php
			}
			echo '</ul>';
			// End show list instructors
		} catch ( \Throwable $e ) {
			echo $e->getMessage();
		}
	}


}