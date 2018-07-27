<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/04/2017
 * Time: 17:50
 */
$image_size  = s7upf_get_size_image('54x64',$image_size);
if('style1' === $style){
    if(!empty($data_add_content) and is_array($data_add_content)) { ?>
        <div class="list-diet <?php echo ('off'===$scrollbar)?'':'custom-scroll'?> <?php echo esc_attr($position_img);?>">
            <?php foreach ($data_add_content as $value) {
                if(!empty($value['link'])) $link = vc_build_link($value['link']); ?>
                <div class="item-diet table">
                    <?php if('left' === $position_img) {?>
                    <div class="diet-thumb"><a href="<?php echo (!empty($link['url']))? esc_url($link['url']): '#'; ?>" <?php if(empty($link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($link['target']))?'_blank':'_parent'; ?>" ><?php if(!empty($value['img'])) echo wp_get_attachment_image($value['img'],$image_size)?></a></div>
                    <?php } ?>
                    <div class="diet-info text-<?php echo esc_attr($position_img);?>">
                        <?php if(!empty($value['title'])){ ?>
                            <h3 class="title18"><a href="<?php echo (!empty($link['url']))? esc_url($link['url']): '#'; ?>" <?php if(empty($link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($link['target']))?'_blank':'_parent'; ?>" class="black"><?php echo esc_attr($value['title']); ?></a></h3>
                        <?php } ?>
                        <?php if(!empty($value['desc'])){ ?>
                            <p class="desc"><?php echo esc_attr($value['desc']); ?></p>
                        <?php } ?>
                    </div>
                    <?php if('right' === $position_img) {?>
                    <div class="diet-thumb"><a href="<?php echo (!empty($link['url']))? esc_url($link['url']): '#'; ?>" <?php if(empty($link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($link['target']))?'_blank':'_parent'; ?>" ><?php if(!empty($value['img'])) echo wp_get_attachment_image($value['img'],$image_size)?></a></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}else{
    if(!empty($bg_image))
    $class_bg = S7upf_Assets::build_css('background: transparent url('.wp_get_attachment_image_url($bg_image,'full').') no-repeat center center / 100% 100%;')?>
    <div class="diet-intro <?php echo esc_attr($class_bg); ?>">
        <?php if(!empty($text_content)){ ?>
            <p class="desc">
                <?php echo esc_attr($text_content);?>
            </p>
        <?php } ?>
    </div>
    <?php
}
?>