<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/04/2017
 * Time: 16:09
 */

global $product;
$type = 'grid';
$type = s7upf_get_option('woo_style_view_way_product');
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
$sub_title = get_post_meta(get_the_ID(),'sub_title_product',true);
if('grid' === $type){
    ?>
    <div class="product-info">
        <h3 class="product-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
        <div class="product-price">
            <?php woocommerce_template_loop_price(); ?>
        </div>
        <?php echo s7upf_get_rating_html(); ?>

        <div class="product-extra-link">
            <?php
            echo s7up_wishlist_url();
            woocommerce_template_loop_add_to_cart();
            echo s7upf_compare_url();
            ?>
        </div>
    </div>

<?php } else{ ?>
    <div class="col-md-8 col-sm-7 col-xs-7">
        <div class="product-info">
            <h3 class="product-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
            <div class="product-price">
                <?php woocommerce_template_loop_price(); ?>
            </div>
            <?php echo s7upf_get_rating_html(); ?>
            <div class="desc">
                <?php the_excerpt(); ?>
            </div>
            <div class="product-extra-link">
                <?php
                woocommerce_template_loop_add_to_cart();
                echo s7up_wishlist_url();
                echo s7upf_compare_url();
                ?>
            </div>
        </div>
    </div>
    <?php
}