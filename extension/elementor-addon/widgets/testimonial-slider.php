<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Testimonial_Slider extends Widget_Base {
	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'newshealth-testimonial-slider';
	}

	public function get_title(): string {
		return esc_html__( 'Testimonial Slider', 'newshealth' );
	}

	public function get_icon(): string {
		return 'eicon-user-circle-o';
	}

	protected function register_controls(): void {

		// content global
		$this->start_controls_section(
			'content_global_section',
			[
				'label' => esc_html__( 'Thông tin chung', 'newshealth' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_global',
			[
				'label' => esc_html__( 'Mô tả', 'newshealth' ),
				'type' => Controls_Manager::WYSIWYG,
				'rows' => 10,
				'default' => esc_html__( 'Mô tả', 'newshealth' ),
			]
		);

		$this->end_controls_section();

		// list testimonial
		$this->start_controls_section(
			'list_section',
			[
				'label' => esc_html__( 'Danh sách', 'newshealth' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_image',
			[
				'label' => esc_html__( 'Ảnh', 'newshealth' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tên', 'newshealth' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Anh L.T.D' , 'newshealth' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_info', [
				'label' => esc_html__( 'Thông tin thêm', 'newshealth' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Cái Răng, Cần Thơ' , 'newshealth' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_description',
			[
				'label' => esc_html__( 'Mô tả', 'newshealth' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Mô tả', 'newshealth' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Danh sách', 'newshealth' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'newshealth' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'newshealth' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		// carousel options
		$this->start_controls_section(
			'options_section',
			[
				'label' => esc_html__( 'Tùy chọn bổ sung', 'newshealth' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'loop',
			[
				'type'          =>  Controls_Manager::SWITCHER,
				'label'         =>  esc_html__('Lặp lại vô hạn', 'newshealth'),
				'label_off'     =>  esc_html__('Không', 'newshealth'),
				'label_on'      =>  esc_html__('Có', 'newshealth'),
				'return_value'  =>  'yes',
				'default'       =>  'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'         =>  esc_html__('Tự động chạy', 'newshealth'),
				'type'          =>  Controls_Manager::SWITCHER,
				'label_off'     =>  esc_html__('Không', 'newshealth'),
				'label_on'      =>  esc_html__('Có', 'newshealth'),
				'return_value'  =>  'yes',
				'default'       =>  'no',
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => esc_html__( 'Thanh điều hướng', 'newshealth' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'  => esc_html__( 'Mũi tên và Dấu chấm', 'newshealth' ),
					'arrows'  => esc_html__( 'Mũi tên', 'newshealth' ),
					'dots'  => esc_html__( 'Dấu chấm', 'newshealth' ),
					'none' => esc_html__( 'Không', 'newshealth' ),
				],
			]
		);

		$this->end_controls_section();

		// responsive
		$this->start_controls_section(
			'responsive_section',
			[
				'label' => esc_html__( 'Responsive', 'newshealth' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// min width 1200
		$this->add_control(
			'min_width_1200',
			[
				'label'     => esc_html__( 'Min Width 1200px', 'newshealth' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_1200',
			[
				'label'   => esc_html__( 'Số lượng hiển thị', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_1200',
			[
				'label'   => esc_html__( 'Khoảng cách', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 24,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		// min width 992
		$this->add_control(
			'min_width_992',
			[
				'label'     => esc_html__( 'Min Width 992px', 'newshealth' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_992',
			[
				'label'   => esc_html__( 'Số lượng hiển thị', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_992',
			[
				'label'   => esc_html__( 'Khoảng cách', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 24,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		// min width 768
		$this->add_control(
			'min_width_768',
			[
				'label'     => esc_html__( 'Min Width 768px', 'newshealth' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_768',
			[
				'label'   => esc_html__( 'Số lượng hiển thị', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 10,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_768',
			[
				'label'   => esc_html__( 'Khoảng cách', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		// min width 576
		$this->add_control(
			'min_width_576',
			[
				'label'     => esc_html__( 'Min Width 576px', 'newshealth' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_576',
			[
				'label'   => esc_html__( 'Số lượng hiển thị', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 10,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_576',
			[
				'label'   => esc_html__( 'Space Between Item', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
				'min'     => 0,
				'max'     => 10,
				'step'    => 1,
			]
		);

		// max width 575
		$this->add_control(
			'max_width_575',
			[
				'label'     => esc_html__( 'Max Width 575px', 'newshealth' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_575',
			[
				'label'   => esc_html__( 'Số lượng hiển thị', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 1,
				'max'     => 10,
				'step'    => 1,
			]
		);

		$this->add_control(
			'margin_item_575',
			[
				'label'   => esc_html__( 'Khoảng cách', 'newshealth' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 12,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->end_controls_section();

		// style description
		$this->start_controls_section(
			'style_description',
			[
				'label' => esc_html__( 'Description', 'newshealth' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     =>  esc_html__( 'Color', 'newshealth' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-testimonial-slider .item .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Typography', 'newshealth' ),
				'selector' => '{{WRAPPER}} .element-testimonial-slider .item .desc',
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$owl_options = [
			'loop'       => ( 'yes' === $settings['loop'] ),
			'nav'        => $settings['navigation'] == 'both' || $settings['navigation'] == 'arrows',
			'dots'       => $settings['navigation'] == 'both' || $settings['navigation'] == 'dots',
			'autoplay'   => ( 'yes' === $settings['autoplay'] ),
			'responsive' => [
				'0' => array(
					'items'  => $settings['item_575'],
					'margin' => $settings['margin_item_575']
				),

				'576' => array(
					'items'  => $settings['item_576'],
					'margin' => $settings['margin_item_576']
				),

				'768' => array(
					'items' => $settings['item_768'],
					'margin' => $settings['margin_item_768'],
				),

				'992' => array(
					'items' => $settings['item_992'],
					'margin' => $settings['margin_item_992'],
				),

				'1200' => array(
					'items' => $settings['item_1200'],
					'margin' => $settings['margin_item_1200'],
				),
			],
		];
		?>

        <div class="element-testimonial-slider">
            <div class="element-testimonial-slider__warp owl-carousel owl-theme custom-equal-height-owl" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
				<?php
				foreach ( $settings['list'] as $item ) :
					$imageId = $item['list_image']['id'];
					?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<?php if ( $settings['content_global'] ) : ?>
                            <div class="item__top-box">
								<?php echo wpautop( $settings['content_global'] ); ?>
                            </div>
						<?php endif; ?>

                        <div class="item__body">
                            <div class="profile">
                                <div class="avatar">
									<?php
									if ( $imageId ) :
										echo wp_get_attachment_image( $item['list_image']['id'], 'full' );
									else:
										?>
                                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/user-avatar.png' ) ) ?>" alt="<?php echo esc_attr( $item['list_title'] ); ?>" />
									<?php endif; ?>
                                </div>

                                <div class="meta">
                                    <p class="name">
										<?php echo esc_html( $item['list_title'] ); ?>
                                    </p>

                                    <p class="info">
										<?php echo esc_html( $item['list_info'] ); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="vote">
								<?php for ($i = 0; $i < 5; $i++) : ?>
                                    <i class="icon icon-star"></i>
								<?php endfor; ?>
                            </div>

                            <div class="desc text-justify">
								<?php echo wp_kses_post( $item['list_description'] ) ?>
                            </div>
                        </div>
                    </div>

				<?php endforeach; ?>
            </div>
        </div>

		<?php
	}
}