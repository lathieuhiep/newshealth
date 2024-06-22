<?php
$phone     = newshealth_get_opt_hotline();
$link_chat = newshealth_get_opt_link_chat_doctor();
$contact_form = newshealth_get_option( 'opt_post_single_contact_form' );
?>
<div class="single-contact-us">
    <div class="grid">
        <div class="grid__item">
            <h4 class="title title-support text-uppercase text-center">
                <?php esc_html_e('Tư vấn trực tuyến', 'newshealth'); ?>
            </h4>

            <div class="list-support">
                <div class="list-support__item">
                    <div class="thumbnail">
                        <img class="alo-circle-anim" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-phone.png' ) ) ?>" alt="" width="65" height="64">
                    </div>

                    <a class="link-phone" href="tel:<?php echo esc_attr(newshealth_preg_replace_ony_number($phone)); ?>">
                        <?php echo esc_html($phone); ?>
                    </a>
                </div>

                <div class="list-support__item">
                    <div class="thumbnail">
                        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-chat.png' ) ) ?>" alt="" width="66" height="60">
                    </div>

                    <a class="link-chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank">
	                    <?php esc_html_e('Chat với bác sĩ', 'newshealth'); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid__item">
            <div class="box-form">
                <h4 class="title title-form text-uppercase text-center">
		            <?php esc_html_e('Đăng ký khám', 'newshealth'); ?>
                </h4>

	            <?php
	            if ( $contact_form ) :
		            echo do_shortcode('[contact-form-7 id="' . $contact_form . '" ]');
	            endif;
	            ?>
            </div>
        </div>
    </div>
</div>