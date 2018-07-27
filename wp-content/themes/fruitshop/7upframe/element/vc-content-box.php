<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/04/2017
 * Time: 17:37
 */
if(!function_exists('s7upf_vc_content_box'))
{
    function s7upf_vc_content_box($attr,$content = false)
    {
        $html = $style = $bg_image =$position_img= $scrollbar=$data_add_content = $add_content = $text_content = $image_size = '' ;
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'image_size'      => '',
            'bg_image'      => '',
            'text_content'      => '',
            'data_add_content'      => '',
            'add_content'      => '',
            'position_img'      => 'left',
            'scrollbar'      => '',

        ),$attr));
        if(isset($add_content))
            $data_add_content= vc_param_group_parse_atts($add_content);
        $html .= S7upf_Template::load_view('elements/content-box',false,array(
            'style' => $style,
            'image_size' => $image_size,
            'bg_image' => $bg_image,
            'text_content' => $text_content,
            'data_add_content' => $data_add_content,
            'position_img' => $position_img,
            'scrollbar' => $scrollbar,

        ));
        return $html;
    }
}

stp_reg_shortcode('s7upf_content_box','s7upf_vc_content_box');

vc_map( array(
    "name"      => esc_html__("SV Content Box", 'fruitshop'),
    "base"      => "s7upf_content_box",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Style', 'fruitshop' ),
            'param_name' => 'style',
            'value' => array(
                esc_html__('Style 1 (List content)','fruitshop')=>'style1',
                esc_html__('Style 2 (Intro content)','fruitshop')=>'style2',
            ),
            'description' => esc_html__( 'Select style', 'fruitshop' )
        ),
        array(
            'type' => 's7up_image_check',
            'param_name' => 'style_content_box',
            'heading' => '',
            'element' => 'style',
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Background image', 'fruitshop' ),
            'param_name' => 'bg_image',
            'description' => esc_html__('Select image from library.','fruitshop'),
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Content', 'fruitshop' ),
            'param_name' => 'text_content',
            'admin_label' => true,
            'description' => esc_html__('Enter text.','fruitshop'),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style2')
            ),
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__('Add Content', 'fruitshop'),
            'param_name' => 'add_content',
            'value' =>'',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title', 'fruitshop' ),
                    'param_name' => 'title',
                    'description' => esc_html__('Enter text.','fruitshop'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__( 'Description', 'fruitshop' ),
                    'param_name' => 'desc',
                    'description' => esc_html__('Enter text.','fruitshop'),
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image (Size: 60px x 60px)', 'fruitshop' ),
                    'param_name' => 'img',
                    'description' => esc_html__('Select image from library.','fruitshop'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Add button', 'fruitshop' ),
                    'param_name' => 'link',
                    'description' => esc_html__('Enter link/URL.','fruitshop'),
                ),
            ),
            'callbacks' => array(
                'after_add' => 'vcChartParamAfterAddCallback'
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'Enable scrollbar', 'fruitshop' ),
            'param_name' => 'scrollbar',
            'group' => esc_html__('Design Option','fruitshop'),
            'value' => array(
                esc_html__('On','fruitshop')=>'',
                esc_html__('Off','fruitshop')=>'off',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),
        array(
            'type' => 'dropdown',
            'admin_label' => true,
            'heading' => esc_html__( 'position image', 'fruitshop' ),
            'param_name' => 'position_img',
            'group' => esc_html__('Design Option','fruitshop'),
            'value' => array(
                esc_html__('Left','fruitshop')=>'left',
                esc_html__('Right','fruitshop')=>'right',
            ),
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Size', 'fruitshop'),
            'param_name' => 'image_size',
            'group' => esc_html__('Design Option','fruitshop'),
            'edit_field_class' => 'vc_column vc_col-sm-12',
            'dependency'    =>array(
                'element'   =>'style',
                'value'     =>array('style1')
            ),
            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'fruitshop'),
        ),
    )
));