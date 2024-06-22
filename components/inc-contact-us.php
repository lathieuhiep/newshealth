<?php
$phone = newshealth_get_opt_hotline();
$medical_appointment_form = newshealth_get_opt_medical_appointment();
$link_chat = newshealth_get_opt_link_chat_doctor();
$link_chat_messenger = newshealth_get_opt_link_chat_messenger();
?>

    <div class="contact-us-group d-none d-lg-block">
        <div class="container">
            <div class="grid-layout text-uppercase">
				<?php if ( $phone ) : ?>
                    <div class="item phone">
                        <div class="item__icon">
                            <i class="icon icon-phone-circle"></i>
                        </div>

                        <div class="item__content">
                            <a href="tel:<?php echo esc_attr(newshealth_preg_replace_ony_number($phone)); ?>">
								<?php esc_html_e('Hotline', 'newshealth'); ?>: <?php echo esc_html($phone); ?>
                            </a>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $medical_appointment_form ) : ?>
                    <div class="item booking">
                        <div class="item__icon">
                            <i class="icon icon-calendar"></i>
                        </div>

                        <div class="item__content">
                            <!-- Button trigger modal -->
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
								<?php esc_html_e('Đặt hẹn khám bệnh', 'newshealth'); ?>
                            </a>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $link_chat ) : ?>
                    <div class="item chat">
                        <div class="item__icon">
                            <i class="icon icon-chat-light"></i>
                        </div>

                        <div class="item__content">
                            <a href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
								<?php esc_html_e('Chat với bác sĩ', 'newshealth'); ?>
                            </a>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $link_chat_messenger ) : ?>
                    <div class="item chat">
                        <div class="item__icon">
                            <i class="icon icon-facebook-messenger"></i>
                        </div>

                        <div class="item__content">
                            <a href="<?php echo esc_url( $link_chat_messenger ); ?>" target="_blank">
								<?php esc_html_e('Chat messenger', 'newshealth'); ?>
                            </a>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>

<?php if ( $medical_appointment_form ) : ?>

    <!-- Modal medical appointment -->
    <div class="modal fade modal-appointment-form" id="modal-appointment-form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
						<?php esc_html_e('Đặt hẹn khám', 'newshealth'); ?>
                    </h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
					<?php echo do_shortcode('[contact-form-7 id="' . $medical_appointment_form . '" ]'); ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>