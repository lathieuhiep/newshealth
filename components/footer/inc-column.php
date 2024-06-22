<?php
$opt_number_columns = newshealth_get_option('opt_footer_columns', '4');

if( is_active_sidebar( 'sidebar-footer-column-1' ) || is_active_sidebar( 'sidebar-footer-column-2' ) || is_active_sidebar( 'sidebar-footer-column-3' ) || is_active_sidebar( 'sidebar-footer-column-4' ) ) :

?>
    <div class="global-footer__column">
        <div class="container">
            <div class="row">
                <?php
                for( $i = 0; $i < $opt_number_columns; $i++ ):
                    $j = $i +1;
                    $newshealth_col = newshealth_get_option( 'opt_footer_column_width_' .  $j, 3);

                    if( is_active_sidebar( 'sidebar-footer-column-'.$j ) ):
                ?>
                    <div class="col-12 col-sm-<?php echo esc_attr( $newshealth_col['sm'] ); ?> col-md-<?php echo esc_attr( $newshealth_col['md'] ); ?> col-lg-<?php echo esc_attr( $newshealth_col['lg'] ); ?> col-xl-<?php echo esc_attr( $newshealth_col['xl'] ); ?>">
                        <?php dynamic_sidebar( 'sidebar-footer-column-'.$j ); ?>
                    </div>
                <?php
                    endif;
                endfor;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>