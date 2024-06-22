<div class="navbar-main">
    <div class="container">
        <div class="grid-layout">
            <div id="primary-menu" class="primary-menu d-none d-lg-block">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class' => 'd-lg-flex reset-list',
                        'container' => false,
                    ) );
                else:
                    ?>
                    <ul class="main-menu">
                        <li>
                            <a href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
                                <?php esc_html_e( 'ADD TO MENU', 'newshealth' ); ?>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="item hamburger d-block d-lg-none ">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="icon-menu"></i>
                </button>
            </div>

            <div class="search-box d-flex align-items-center">
                <?php get_search_form() ?>
            </div>
        </div>
    </div>
</div>