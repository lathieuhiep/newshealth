<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Clinic_Elementor_Post_Grid extends Widget_Base
{
	public function get_categories(): array {
		return array('my-theme');
	}

	public function get_name(): string {
		return 'newshealth-post-grid';
	}

	public function get_title(): string {
		return esc_html__('Posts Grid', 'newshealth');
	}

	public function get_icon(): string {
		return 'eicon-gallery-grid';
	}

	protected function register_controls(): void {

		// Content query
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Query', 'newshealth'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_cat',
			[
				'label' => esc_html__('Select Category', 'newshealth'),
				'type' => Controls_Manager::SELECT2,
				'options' => newshealth_check_get_cat('category'),
				'label_block' => true
			]
		);

		$this->add_control(
			'limit',
			[
				'label' => esc_html__('Number of Posts', 'newshealth'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
				'max' => 100,
				'step' => 1,
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__('Order By', 'newshealth'),
				'type' => Controls_Manager::SELECT,
				'default' => 'id',
				'options' => [
					'id' => esc_html__('Post ID', 'newshealth'),
					'author' => esc_html__('Post Author', 'newshealth'),
					'title' => esc_html__('Title', 'newshealth'),
					'date' => esc_html__('Date', 'newshealth'),
					'rand' => esc_html__('Random', 'newshealth'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__('Order', 'newshealth'),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__('Ascending', 'newshealth'),
					'DESC' => esc_html__('Descending', 'newshealth'),
				],
			]
		);

		$this->end_controls_section();

		// Content layout
		$this->start_controls_section(
			'content_layout',
			[
				'label' => esc_html__('Layout Settings', 'newshealth'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__('Show excerpt', 'newshealth'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'show' => [
						'title' => esc_html__('Yes', 'newshealth'),
						'icon' => 'eicon-check',
					],

					'hide' => [
						'title' => esc_html__('No', 'newshealth'),
						'icon' => 'eicon-ban',
					]
				],
				'default' => 'show'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => esc_html__('Excerpt Words', 'newshealth'),
				'type' => Controls_Manager::NUMBER,
				'default' => '40',
				'condition' => [
					'show_excerpt' => 'show',
				],
			]
		);

		$this->end_controls_section();

		// Style title
		$this->start_controls_section(
			'style_title',
			[
				'label' => esc_html__('Title', 'newshealth'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'newshealth'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .element-post-grid__warp .item__box .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Color Hover', 'newshealth'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .element-post-grid__warp .item__box .title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .element-post-grid__warp .item__box .title',
			]
		);

		$this->end_controls_section();

		// Style excerpt
		$this->start_controls_section(
			'style_excerpt',
			[
				'label' => esc_html__('Excerpt', 'newshealth'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'show',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__('Color', 'newshealth'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .element-post-grid__warp .item__box .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .element-post-grid__warp .item__box .content',
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$cat_post = $settings['select_cat'];
		$limit_post = $settings['limit'];
		$order_by_post = $settings['order_by'];
		$order_post = $settings['order'];

		// Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $limit_post,
			'orderby' => $order_by_post,
			'order' => $order_post,
			'cat' => $cat_post,
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) :

			?>

            <div class="element-post-grid">
                <div class="element-post-grid__warp">
					<?php $stt = 1; while ($query->have_posts()): $query->the_post(); ?>
                        <div class="item">
                            <div class="item__thumbnail">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        the_post_thumbnail('large');
                                    else:
                                        ?>
                                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/no-image.png')) ?>"
                                             alt="<?php the_title(); ?>"/>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="item__box">
                                <h3 class="title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <?php if ( $settings['show_excerpt'] == 'show' ) : ?>
                                    <div class="content">
                                        <p>
                                            <?php
                                            if (has_excerpt()) :
                                                echo esc_html(wp_trim_words(get_the_excerpt(), $settings['excerpt_length'], '...'));
                                            else:
                                                echo esc_html(wp_trim_words(get_the_content(), $settings['excerpt_length'], '...'));
                                            endif;
                                            ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
					<?php
                        $stt++;
                    endwhile;
					wp_reset_postdata();
                    ?>
                </div>
            </div>

		<?php

		endif;
	}

}