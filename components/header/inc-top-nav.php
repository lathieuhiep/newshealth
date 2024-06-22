<?php
$logo = newshealth_get_option( 'opt_general_logo' );
$banner = newshealth_get_option( 'opt_general_banner' );
?>

<div class="header-time">
    <div class="container">
        <div id="clock"></div>
    </div>
</div>

<div class="top-nav">
    <div class="container">
        <div class="grid-layout">
            <div class="logo">
                <a class="d-block" href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
                    <?php
                    if ( ! empty( $logo['id'] ) ) :
                        echo wp_get_attachment_image( $logo['id'], 'full' );
                    else :
                    ?>
                        <img class="logo-default" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" />
                    <?php endif; ?>
                </a>
            </div>

            <div class="banner">
                <?php
                if ( !empty( $banner ) ) :
                    echo wp_get_attachment_image( $banner['id'], 'full' );
                endif;
                ?>
            </div>
        </div>
    </div>
</div>