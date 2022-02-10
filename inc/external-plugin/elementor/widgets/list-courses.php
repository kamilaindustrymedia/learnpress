<?php
namespace Elementor;

class LP_Elementor_Widget_List_Courses extends LP_Elementor_Widget_Base {

	public function get_name() {
		return 'learnpress_list_courses';
	}

	public function get_title() {
		return esc_html__( 'List Courses', 'learnpress' );
	}

	public function get_keywords() {
		return array( 'learnpress', 'list courses' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	protected function register_controls() {

		$this->_register_control_content();

	}

	protected function _register_control_content() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'learnpress' ),
			)
		);
		$this->add_control(
			'grid_list_type',
			array(
				'label'   => esc_html__( 'Layout Type', 'learnpress' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'list' => esc_html__( 'List', 'learnpress' ),
					'grid' => esc_html__( 'Grid', 'learnpress' ),
				),
				'default' => 'grid',
			)
		);
		$this->add_control(
			'cat_id',
			array(
				'label'   => esc_html__( 'Select Category', 'learnpress' ),
				'default' => '',
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_cat_taxonomy( 'course_category', array( '' => esc_html__( 'All', 'learnpress' ) ) ),
			)
		);
		$this->add_control(
			'order_by',
			array(
				'label'   => esc_html__( 'Order By', 'learnpress' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'desc' => esc_html__( 'DESC', 'learnpress' ),
					'asc'  => esc_html__( 'ASC', 'learnpress' ),
				),
				'default' => 'desc',
			)
		);
		$this->add_control(
			'course_type',
			array(
				'label'   => esc_html__( 'Course Type', 'learnpress' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''         => esc_html__( 'Default', 'learnpress' ),
					'recent'   => esc_html__( 'Recent', 'learnpress' ),
					'popular'  => esc_html__( 'Popular', 'learnpress' ),
					'featured' => esc_html__( 'Featured', 'learnpress' ),
				),
				'default' => '',
			)
		);
		$this->add_control(
			'number_posts',
			array(
				'label'   => esc_html__( 'Number Post', 'learnpress' ),
				'default' => '4',
				'type'    => Controls_Manager::NUMBER,
			)
		);

		$this->end_controls_section();
	}

	protected function get_cat_taxonomy( $taxomony = 'category', $cats = false ) {
		if ( ! $cats ) {
			$cats = array();
		}
		$terms = new \WP_Term_Query(
			array(
				'taxonomy'     => $taxomony,
				'pad_counts'   => 1,
				'hierarchical' => 1,
				'hide_empty'   => 1,
				'orderby'      => 'name',
				'menu_order'   => true,
			)
		);

		if ( is_wp_error( $terms ) ) {
		} else {
			if ( empty( $terms->terms ) ) {
			} else {
				foreach ( $terms->terms as $term ) {
					$prefix = '';
					if ( $term->parent > 0 ) {
						$prefix = '--';
					}
					$cats[ $term->term_id ] = $prefix . $term->name;
				}
			}
		}

		return $cats;
	}

	public function render() {
		$settings      = $this->get_settings_for_display();
		$filter        = new \LP_Course_Filter();
		$filter->limit = $settings['number_posts'];
		$course_type   = $settings['course_type'];
		$courses       = array();

		if ( $settings['cat_id'] ) {
			$filter->term_ids = array( $settings['cat_id'] );
		}

		if ( $settings['order_by'] ) {
			$filter->order .= $settings['order_by'];
		}

		switch ( $course_type ) {
			case 'recent':
				$filter->order_by .= 'p.post_date';
				$courses           = \LP_Course::get_courses( $filter );
				break;
			case 'popular':
				$filter->sort_by = 'on_popular';
				$courses         = \LP_Course::get_courses( $filter );
				break;
			case 'featured':
				$filter->sort_by = 'on_feature';
				$courses         = \LP_Course::get_courses( $filter );
				break;
			default:
				$courses = \LP_Course::get_courses( $filter );
		}

		if ( empty( $courses ) ) {
			return;
		}
		?>
		<div class="lp-archive-courses">
			<ul class="learn-press-courses" data-layout="<?php echo $settings['grid_list_type']; ?>" data-size="<?php echo absint( $settings['number_posts'] ); ?>">
				<?php
				global $post;
				foreach ( $courses as $course ) {
					$post = $course;
					setup_postdata( $course );
					learn_press_get_template( 'content-course.php' );
				}
				wp_reset_postdata();
				?>
			</ul>
		</div>
		<?php
	}

}
