<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/04/2017
 * Time: 10:08
 */
$custom_size_img = s7upf_get_size_image('full',$image_size);
$img_overlay = true;

$data_date=get_option('date_format');
if(!empty($date_format))
    $data_date= $date_format;

if($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post(); ?>
        <article class="item-post-masonry">
             <?php

            if (!empty($post_format)) {
                if (has_post_thumbnail()) { ?>
                    <div class="banner-adv overlay-image zoom-image mb-media">
                        <a href="<?php the_permalink(); ?>"
                           class="adv-thumb-link"><?php the_post_thumbnail($custom_size_img); ?></a>
                    </div>
                   
                <?php }
            } else {
                echo S7upf_Template::load_view('blog-content/media-post', false, array(
                    'image_size' => $image_size,
                    'img_overlay' => $img_overlay,
                ));
            
            }
            ?>
            <div class="blog-info">
                <ul class="list-inline-block blog-comment-date">
                    <li><label><?php echo esc_html__('Fecha: ','fruitshop'); ?></label><span class="whiter"><?php echo get_the_date($data_date); ?></span></li>
                </ul>
                <h2 class="title20"><a href="<?php the_permalink(); ?>" class="black"><?php the_title(); ?></a></h2>
                <p class="desc">
                    <?php if (!empty($word_excerpt)) { ?>
                        <?php if (has_excerpt(get_the_ID())) {
                            echo balanceTags(wp_trim_words(get_the_excerpt(), $word_excerpt, '...'), true);
                        } else echo balanceTags(wp_trim_words(get_the_content(), $word_excerpt, '... '), true); ?>
                    <?php } ?>
                </p>
                <div class="table social-readmore">
                    <div class="text-left">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>"
                           class="shop-button"><?php esc_html_e('Leer Más', 'fruitshop') ?></a>
                    </div>
                    <?php s7upf_display_metabox('share_post'); ?>
                </div>
            </div>
        </article>
        <!-- End Item -->
        <?php
    }
}
