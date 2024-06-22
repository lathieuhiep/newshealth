<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Banner extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'newshealth-banner';
    }

    public function get_title(): string {
        return esc_html__( 'Banner', 'newshealth' );
    }

    public function get_icon(): string {
        return 'eicon-image';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['banner', 'image' ];
    }

    protected function register_controls(): void {

        // Content testimonial
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'newshealth' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Sử dụng ảnh ở mục banner trong theme options', 'newshealth' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $banner_pc = newshealth_get_option('opt_general_banner_pc');
        $banner_mobile = newshealth_get_option('opt_general_banner_mobile');
    ?>

        <div class="element-banner">
            <?php if ( !empty( $banner_pc ) ) : ?>
                <div class="banner-pc">
                    <?php echo wp_get_attachment_image( $banner_pc['id'], 'full' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $banner_mobile ) ) : ?>
                <div class="banner-mobile">
                    <?php echo wp_get_attachment_image( $banner_mobile['id'], 'full' ); ?>
                </div>
            <?php endif; ?>
        </div>

    <?php
    }
}