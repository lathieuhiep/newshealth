<?php
$id_cf = newshealth_get_option( 'opt_general_cf' );
?>
<div class="contact-mobile d-lg-none">
    <div class="warp-cf">
        <?php
        if ( $id_cf ) :
            echo do_shortcode('[contact-form-7 id="' . $id_cf . '" ]');
        endif;
        ?>
    </div>
</div>