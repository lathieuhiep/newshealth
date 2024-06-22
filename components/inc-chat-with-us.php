<?php
$call_phone = newshealth_get_opt_hotline();
$chat_zalo = newshealth_get_opt_chat_zalo();
$link_messenger = newshealth_get_opt_link_chat_messenger()
?>

<div class="chat-with-us">
	<?php
	if ( !empty( $chat_zalo ) ) :
        $zalo_selcet = $chat_zalo['select_zalo'];

        if ( $zalo_selcet == 'phone_qr' ) :
            $zalo_phone = $chat_zalo['phone'];
            $zalo_qr_code = $chat_zalo['qr_code'];
    ?>
        <a class="link chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( newshealth_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>">
            <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
    <?php else: ?>
        <a class="link" href="<?php echo esc_url( $chat_zalo['link'] ); ?>" target="_blank">
            <img alt="zalo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/zalo-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php
        endif;
    endif;
    ?>

	<?php if ( $link_messenger ) : ?>
        <a class="link chat-with-us__messenger" href="<?php echo esc_url($link_messenger); ?>" target="_blank">
            <img alt="facebook" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/mess-facebook-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>

	<?php if ($call_phone) : ?>
        <a class="link chat-with-us__phone alo-circle-anim" href="tel:<?php echo esc_attr(newshealth_preg_replace_ony_number($call_phone)); ?>">
            <img alt="phone" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/phone-icon-contact.png' ) ) ?>" width="50" height="" />
        </a>
	<?php endif; ?>
</div>