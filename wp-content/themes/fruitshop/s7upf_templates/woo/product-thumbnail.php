<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14/04/2017
 * Time: 15:26
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $product;
global $post;
$default_image = get_template_directory_uri().'/assets/images/placeholder.png';
$attachment_ids = $product->get_gallery_image_ids();
$image_size = s7upf_get_option('s7upf_image_size_list_product');
$image_size = s7upf_get_size_image('full',$image_size);
if(!empty($image_size_element)){
    $image_size  = s7upf_get_size_image('300x330',$image_size_element);
}
$type = 'grid';
$type = s7upf_get_option('woo_style_view_way_product');
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
if('grid' === $type){  ?>
    <div class="product-thumb">
        <?php
        /**
         * s7upf_before_shop_product_thumb hook.
         *
         * @hooked s7upf_template_loop_product_label_icon - 10
         */
        do_action( 's7upf_before_shop_product_thumb' );
        ?>
        <a href="<?php the_permalink(); ?>" class="product-thumb-link <?php if(count($attachment_ids)>=1) echo 'rotate-thumb'?> ">
            <?php
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail(get_the_ID(),$image_size);
            }
            if(is_array($attachment_ids) and count($attachment_ids)>0){
                foreach ($attachment_ids as $key => $value){
                    if($key == 0){
                        echo wp_get_attachment_image($value,$image_size,false);
                    }
                }
            }
            ?>
        </a>
        <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><i class="fa fa-search" aria-hidden="true"></i></a>
    </div>
<?php } else{?>
    <div class="col-md-4 col-sm-5 col-xs-5">

        <div class="product-thumb">
            <?php
            /**
             * s7upf_before_shop_product_thumb hook.
             *
             * @hooked s7upf_template_loop_product_label_icon - 10
             */
            do_action( 's7upf_before_shop_product_thumb' );?>
            <a href="<?php the_permalink(); ?>" class="product-thumb-link <?php if(count($attachment_ids)>=1) echo 'zoomout-thumb'?>">
                <?php
                if ( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail(get_the_ID(),$image_size);
                }
                if(is_array($attachment_ids) and count($attachment_ids)>0){
                    foreach ($attachment_ids as $key => $value){
                        if($key == 0){
                            echo wp_get_attachment_image($value,$image_size,false);
                        }
                    }
                }
                ?>
            </a>
            <a data-product-id="<?php echo get_the_id();?>" href="<?php the_permalink(); ?>" class="quickview-link product-ajax-popup"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
<?php }