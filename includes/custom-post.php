<?php 



class wedevs_custom_post_Metabox_pl{
    public function __construct(){

        add_action('init',[$this, 'wedevs_custom_post_Metabox_post'] );
        add_action('add_meta_boxes', [$this, 'wedevs_custom_post_Meta_box']);

        add_action('save_post_movies', [$this, 'wedevs_custom_save_post_Meta_box']);
        //cmb2 hook 
       add_action( 'cmb2_admin_init', [$this, 'wedevs_custom_cmb2_metabox'] );
        
        /**
         * if you want that the post type which is save this post type that will be save
         * do_action( “save_post_{$post->post_type}”, int $post_id, WP_Post $post, bool $update )
         */
        

    }

    public function wedevs_custom_post_Metabox_post(){
        register_post_type( 'movies',
        // CPT Options
            array(
                'labels' => array(
                    'name' => __( 'Movies' ),
                    'singular_name' => __( 'Movie' ),
                    'add_new_item' => __( 'Add New Movie' ),
                     'add_new'  => __( 'Add New firoz' ),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'movies'),
                'show_in_rest' => true,
      
            )
        );
    }

    /**
     * Metabox
     */ 
    public function wedevs_custom_post_Meta_box(){
        add_meta_box(
             'wedevs-custom-post-metabox-ones', 
             'Movie Details',
            [$this, 'wedevs_custom_post_metabox_callback'],
            'movies',
        );
    }


    /**
     * Save  data for metabox
     * @param mixed $post_id
     * @return void
     */
    public function wedevs_custom_save_post_Meta_box($post_id){ 
        if(isset($_POST['metabox-ones'])){
            $text_field=sanitize_text_field($_POST['metabox-ones']);
        update_post_meta($post_id, '_metabox-ones',$text_field ); 
        }

        if(isset($_POST['asociated_page'])){
            // obosoisio have to sanitize 
            $text_field=intval($_POST['asociated_page']);
        update_post_meta($post_id, '_asociated_page',$text_field ); 
        }
       
    }

    public function wedevs_custom_post_metabox_callback($post){
      

       $post_id= get_post_meta($post->ID,  '_metabox-ones',    true);
       $asociated_page= get_post_meta($post->ID,  '_asociated_page',    true);

       $posts=get_posts([
           'post_type' => 'page',
       ]);

       
       /**
        * how to query data from database please flow under the code 
        */

      ?>
        <label for="wedevs-custom-post-metabox-ones">odrer now</label>
       
      </p>
      <input Tyle="width:100%; display:block" type="text" name="metabox-ones" value="<?php echo esc_attr($post_id);?>">
        <p>
            <label for="select">Select Your Item</label>
            <select name="asociated_page" id="select">
                <?php foreach ($posts as $post):?>

                <option value="<?php echo esc_html($post->ID);?> <?php echo $asociated_page== $post->ID ? 'selected' : ''; ?>"><?php echo esc_html($post->post_title);?></option>
                <?php endforeach;?>
                
            </select>
        </p>

      
      <?php 
       
    }


    /**
     * Summary of wedevs_custom_cmb2_metabox
     *this is for custom metabox that will be show in admin panel 
     * @return void
     */
    public function wedevs_custom_cmb2_metabox(){
        $cmb=new_cmb2_box([
            'id'            => 'cmb2_metabox',
            'title'         => 'CMB2 Metabox',
            'object_types'  => ['movies'],
            'context'       => 'normal',
            'priority'      => 'high',
           // 'show_names'    => true
        ]);

        $cmb->add_field([
            'name' => 'Movie Name',
            'id'   => 'metabox-ones',
            'type' => 'textarea',
        ]); 
        $cmb->add_field( [
            'name' => 'Entry Image',
            'id'   => 'image',
            'type' => 'file',
        ] );

    }
    

}