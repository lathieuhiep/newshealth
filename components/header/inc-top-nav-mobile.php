<?php
$logo_mobile = newshealth_get_option( 'opt_general_logo_mobile' );
$hotline = newshealth_get_opt_hotline();
?>
<div class="top-nav-mobile d-lg-none">
    <div class="container h-100">
        <div class="grid-warp h-100">
            <div class="item hamburger">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="icon-menu"></i>
                </button>
            </div>

            <div class="item logo text-center">
                <a class="logo__image" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo_mobile['id'] ) ) :
                        echo wp_get_attachment_image( $logo_mobile['id'], 'full' );
                    else :
                    ?>

                        <img class="logo-default"
                             src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                             alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>

                    <?php endif; ?>
                </a>
            </div>

            <?php if ( $hotline ) : ?>
                <div class="item contact">
                    <a href="tel:<?php echo esc_attr( newshealth_preg_replace_ony_number($hotline) ); ?>">
                        <svg class="icon alo-circle-anim" xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.35888 0.205162L3.24417 0.0281045C3.85929 -0.0949189 4.4834 0.193694 4.78804 0.742052L6.29826 3.46046C6.61104 4.02346 6.5127 4.72559 6.05729 5.181L5.04056 6.19773C4.5726 6.66625 4.48374 7.39321 4.82549 7.9604C5.399 8.91392 6.0666 9.77154 6.8283 10.5332C7.59001 11.2949 8.44701 11.9619 9.39933 12.5342C9.9666 12.8745 10.6926 12.7852 11.1606 12.3177L12.1773 11.301C12.6327 10.8456 13.3348 10.7473 13.8978 11.06L16.6162 12.5703C17.1646 12.8749 17.4532 13.499 17.3302 14.1141L17.1531 14.9994C17.0685 15.4222 16.7992 15.785 16.4184 15.9872C12.8454 17.8917 8.9682 16.7531 4.78668 12.5716C0.605155 8.3901 -0.533362 4.51287 1.37113 0.93995C1.5733 0.559101 1.93609 0.289794 2.35888 0.205162Z" fill="#04916F"/>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>