<?php
$phone = newshealth_get_opt_hotline();
$link_chat = newshealth_get_opt_link_chat_doctor();
$chat_zalo = newshealth_get_opt_chat_zalo();
?>

<div class="contact-us-mobile d-lg-none">
    <div class="warp">
        <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/chan-trang-lien-he.gif' ) ) ?>" alt="">

        <?php if ( $link_chat ) : ?>
            <a class="item chat" href="<?php echo esc_url( $link_chat ); ?>" target="_blank"></a>
        <?php endif; ?>

        <?php if ( $phone ) : ?>
            <a class="item phone" href="tel:<?php echo esc_attr(newshealth_preg_replace_ony_number($phone)); ?>"></a>
        <?php endif; ?>

        <?php
        if ( !empty( $chat_zalo ) ) :
            $zalo_selcet = $chat_zalo['select_zalo'];

            if ( $zalo_selcet == 'phone_qr' ) :
                $zalo_phone = $chat_zalo['phone'];
                $zalo_qr_code = $chat_zalo['qr_code'];
            ?>
                <a class="item chat-with-us__zalo" href="https://zalo.me/<?php echo esc_attr( newshealth_preg_replace_ony_number($zalo_phone) ) ?>" data-phone="<?php echo esc_attr($zalo_phone); ?>" data-qr-code="<?php echo esc_attr($zalo_qr_code); ?>"></a>
            <?php else: ?>
                <a class="item" href="<?php echo esc_url( $chat_zalo['link'] ); ?>" target="_blank"></a>
        <?php
            endif;
        endif;
        ?>
    </div>
</div>