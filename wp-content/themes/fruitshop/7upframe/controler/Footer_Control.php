<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_FooterController'))
{
    class S7upf_FooterController{

        static function _init()
        {
            if(function_exists('stp_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type()
        {
            $labels = array(
                'name'               => esc_html__('Footer Page','fruitshop'),
                'singular_name'      => esc_html__('Footer Page','fruitshop'),
                'menu_name'          => esc_html__('Footer Page','fruitshop'),
                'name_admin_bar'     => esc_html__('Footer Page','fruitshop'),
                'add_new'            => esc_html__('Add New','fruitshop'),
                'add_new_item'       => esc_html__( 'Add New Footer Page','fruitshop' ),
                'new_item'           => esc_html__( 'New Footer Page', 'fruitshop' ),
                'edit_item'          => esc_html__( 'Edit Footer Page', 'fruitshop' ),
                'view_item'          => esc_html__( 'View Footer Page', 'fruitshop' ),
                'all_items'          => esc_html__( 'All Footer Page', 'fruitshop' ),
                'search_items'       => esc_html__( 'Search Footer Page', 'fruitshop' ),
                'parent_item_colon'  => esc_html__( 'Parent Footer Page:', 'fruitshop' ),
                'not_found'          => esc_html__( 'No footer page found.', 'fruitshop' ),
                'not_found_in_trash' => esc_html__( 'No footer page found in Trash.', 'fruitshop' ),

            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'footerpage' ),
                'capability_type'    => 'page',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_icon'           => get_template_directory_uri().'/assets/admin/image/footer.png',
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
            );

            stp_reg_post_type('footerpage',$args);
        }


    }

    S7upf_FooterController::_init();

}