<?php
function booking_vehicle_register() {
    $labels = array(
        'name' => _x('Booking Vehicle', 'post type general name'),
        'singular_name' => _x('Booking Vehicle Item', 'post type singular name'),
        'add_new' => _x('Add New', 'vehicle item'),
        'add_new_item' => __('Add New Booking Vehicle Item'),
        'edit_item' => __('Edit Booking Vehicle Item'),
        'new_item' => __('New Booking Vehicle Item'),
        'view_item' => __('View Booking Vehicle Item'),
        'search_items' => __('Search Booking Vehicle Items'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 8,
        'supports' => array('title')
    ); 
    register_post_type( 'booking_vehicle' , $args );
}
add_action('init', 'booking_vehicle_register');


add_action( 'admin_init', 'MetaBox_post' );
function MetaBox_post() {
    add_meta_box( 'post_meta_box', 'Price Details', 'display_post_meta_box','post', 'normal', 'high' );
}

function display_post_meta_box( $post ) {
    ?>
    <table width="100%">
         <tr>
            <td>Price</td>
            <td>
			<input type="text" style="width:425px;" name="meta[post_price]" placeholder="$"  value="<?php echo esc_html( get_post_meta( $post->ID, 'post_price', true ) );?>" />
            </td>
        </tr>
        
    </table>
<?php 
}

add_action( 'save_post', 'add_post_fields', 10, 2 );
function add_post_fields( $booking_vehicle_id, $booking_vehicle ) {
    if ( $booking_vehicle->post_type == 'post' ) {
		
        if ( isset( $_POST['meta'] ) ) {
            foreach( $_POST['meta'] as $key => $value ){
                update_post_meta( $booking_vehicle_id, $key, $value );
            }
        }
    }
}


add_action( 'admin_init', 'MetaBox_booking_vehicle' );
function MetaBox_booking_vehicle() {
    add_meta_box( 'booking_vehicle_meta_box', 'Booking Details', 'display_booking_vehicle_meta_box','booking_vehicle', 'normal', 'high' );
}
function display_booking_vehicle_meta_box( $booking_vehicle ) {
    ?>
    <!--<h4>Booking Details</h4>-->
    <table width="100%">
        <tr>
            <td style="width: 25%">First Name</td>
            <td>
			<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_first_name', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_first_name]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_first_name', true ) );?>" /><?php */?>
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_last_name', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_last_name]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_last_name', true ) );?>" /><?php */?>
            </td>
        </tr>
        <tr>
            <td>Email ID</td>
            <td>
			<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_email', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_email]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_email', true ) );?>" /><?php */?>
            </td>
        </tr>
        
        <tr>
            <td>Phone</td>
            <td>
			<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_phone', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_phone]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_phone', true ) );?>" /><?php */?>
            </td>
        </tr>
        
         <tr>
            <td>Vehicle Category</td>
            <td>
			<?php echo get_cat_name(esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_cat', true ) ));?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_cat]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_cat', true ) );?>" /><?php */?>
            </td>
        </tr>
        
         <tr>
            <td>Vehicle Post</td>
            <td><?php echo get_the_title(get_post_meta( $booking_vehicle->ID, 'booking_vehicle_post', true ));?>
            <?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_post]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_post', true ) );?>" /><?php */?>
            </td>
        </tr>
        
         <tr>
            <td>Vehicle Price</td>
            <td>$<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_price', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_price]" placeholder="$"  value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_price', true ) );?>" /><?php */?>
            </td>
        </tr>
        
        <tr>
            <td>Message</td>
            <td>
			<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_description', true ) );?>
			<?php /*?><input type="text" style="width:425px;" name="meta[booking_vehicle_description]" value="<?php echo esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_description', true ) );?>" /><?php */?>
            </td>
        </tr>
        
        <tr>
            <td>Status </td>
            <td>
            <?php $bookign_status = esc_html( get_post_meta( $booking_vehicle->ID, 'booking_vehicle_status', true ) ); ?>
            <select name="booking_vehicle_status" id="booking_vehicle_status">
            <option value="Pending" <?=$bookign_status == 'Pending' ? ' selected="selected"' : '';?>>Pending</option>
            <option value="Approved" <?=$bookign_status == 'Approved' ? ' selected="selected"' : '';?>>Approved</option>
            <option value="Reject" <?=$bookign_status == 'Reject' ? ' selected="selected"' : '';?>>Reject</option>
            <option value="On the way" <?=$bookign_status == 'On the way' ? ' selected="selected"' : '';?>>On the way</option>
            <option value="Complete" <?=$bookign_status == 'Complete' ? ' selected="selected"' : '';?>>Complete</option>
            </select>
			
            </td>
        </tr>
        
        
    </table>
<?php 
}
add_action( 'save_post', 'add_booking_vehicle_fields', 10, 2 );
function add_booking_vehicle_fields( $booking_vehicle_id, $booking_vehicle ) {
    if ( $booking_vehicle->post_type == 'booking_vehicle' ) {
		
		if ( isset( $_POST['booking_vehicle_status'] ) ) { // Input var okay.
		
			$booking_vehicle_first_name = esc_html( get_post_meta( $booking_vehicle_id, 'booking_vehicle_first_name', true ) );
			$booking_vehicle_last_name = esc_html( get_post_meta( $booking_vehicle_id, 'booking_vehicle_last_name', true ) );
		
			$subject = $_POST['booking_vehicle_status']." Booking";
			$data_html ='';
			$data_html .='<p> Dear '.ucwords($booking_vehicle_last_name." ".$booking_vehicle_first_name).',<p>';
			
			if($_POST['booking_vehicle_status'] == 'Approved'){
				$data_html .='<p> Your booking is Approved.</p>';
			}
			if($_POST['booking_vehicle_status'] == 'Reject'){
				$data_html .='<p> Your booking is Rejected.</p>';
			}
		    if($_POST['booking_vehicle_status'] == 'On the way'){
				$data_html .='<p> Your booking is On the way.</p>';
			}
			if($_POST['booking_vehicle_status'] == 'Complete'){
				$data_html .='<p> Thanks! Your booking is Completed.</p>';
			}
			
			mail_format_and_send_process($subject,$data_html,$booking_vehicle_email,$cc_mail,$bcc_mail);
	
			update_post_meta( $booking_vehicle_id, 'booking_vehicle_status', sanitize_text_field( wp_unslash( $_POST['booking_vehicle_status'] ) ) ); // Input var okay.
		}
		
        /*if ( isset( $_POST['meta'] ) ) {
            foreach( $_POST['meta'] as $key => $value ){
                update_post_meta( $booking_vehicle_id, $key, $value );
            }
        }*/
    }
}

function mail_format_and_send_process( $subject, $data_html, $to_mail, $cc_mail = null, $bcc_mail = null )
{
	if(isset($to_mail))
	{
		$subject 	= $subject;	
		$admin_email = get_option('admin_email');

		    $headers[] = 'Content-Type: text/html; charset=UTF-8';
		    $headers[] = 'From: Booking Admin <'.$admin_email.'>';
		    if($cc_mail!='')
		    {
		    	$headers[] = 'Cc: '.$cc_mail.' <'.$cc_mail.'>';
		    }

		    if($bcc_mail!='')
		    {
		    	$headers[] = 'Bcc: '.$bcc_mail; 
		    }
		     
    		wp_mail( $to_mail, $subject, $data_html, $headers );
	}
			
}

/*function create_booking_vehicle_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' ),
    );

    register_taxonomy( 'booking_vehicle_categories', array( 'vehicle' ), $args );
}
add_action( 'init', 'create_booking_vehicle_taxonomies', 0 );*/



add_shortcode( 'booking_vehicle_form', 'booking_vehicle_form_input_fields' ); 
function booking_vehicle_form_input_fields( $atts ) {
   if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "booking_vehicle_new_post") {

    // Do some minor form validation to make sure there is content
    if (isset ($_POST['booking_vehicle_title'])) {
        $booking_vehicle_title =  $_POST['booking_vehicle_title'];
    } else {
        echo 'Please enter a  title';
    }
    if (isset ($_POST['booking_vehicle_first_name'])) {
        $booking_vehicle_first_name = $_POST['booking_vehicle_first_name'];
    } else {
        echo 'Please enter the First Name';
    }
	
	if (isset ($_POST['booking_vehicle_last_name'])) {
        $booking_vehicle_last_name = $_POST['booking_vehicle_last_name'];
    } else {
        echo 'Please enter the Last Name';
    }
	
	if (isset ($_POST['booking_vehicle_email'])) {
        $booking_vehicle_email = $_POST['booking_vehicle_email'];
    } else {
        echo 'Please enter Email ID';
    }
	
	if (isset ($_POST['booking_vehicle_phone'])) {
        $booking_vehicle_phone = $_POST['booking_vehicle_phone'];
    } else {
        echo 'Please enter the Phone No.';
    }
	
	
	if (isset ($_POST['cat'])) {
        $booking_vehicle_cat = $_POST['cat'];
    } else {
        echo 'Please Select Catrgory';
    }
	
	if (isset ($_POST['_select'])) {
        $booking_vehicle_post = $_POST['_select'];
    } else {
        echo 'Please Select Vehicle';
    }
	
	if (isset ($_POST['booking_vehicle_price'])) {
        $booking_vehicle_price = $_POST['booking_vehicle_price'];
    } 
	
	if (isset ($_POST['booking_vehicle_description'])) {
        $booking_vehicle_description = $_POST['booking_vehicle_description'];
    } else {
        echo 'Please enter the content';
    }
	
	
    $tags = $_POST['post_tags'];

    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $booking_vehicle_title,
        'post_content'  => $booking_vehicle_description,
        'post_category' => array($booking_vehicle_cat),  // Usable for custom taxonomies too
        'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
        'post_type' => 'booking_vehicle'  //'post',page' or use a custom post type if you want to
    );
    //save the new post
    $pid = wp_insert_post($new_post); 
    //insert meta box
	add_post_meta($pid, 'booking_vehicle_first_name', $booking_vehicle_first_name, true);
	add_post_meta($pid, 'booking_vehicle_last_name', $booking_vehicle_last_name, true);
	add_post_meta($pid, 'booking_vehicle_email', $booking_vehicle_email, true);
	add_post_meta($pid, 'booking_vehicle_phone', $booking_vehicle_phone, true);
	add_post_meta($pid, 'booking_vehicle_cat', $booking_vehicle_cat, true);
	add_post_meta($pid, 'booking_vehicle_post', $booking_vehicle_post, true);
	add_post_meta($pid, 'booking_vehicle_price', $booking_vehicle_price, true);
	add_post_meta($pid, 'booking_vehicle_description', $booking_vehicle_description, true);
	add_post_meta($pid, 'booking_vehicle_status', 'Pending', true);
	
	$booking_vehicle_first_name = esc_html( get_post_meta( $pid, 'booking_vehicle_first_name', true ) );
	$booking_vehicle_last_name = esc_html( get_post_meta( $pid, 'booking_vehicle_last_name', true ) );
	
	$subject = "Pending Booking";
	$data_html ='';
	$data_html .='<p> Dear '.ucwords($booking_vehicle_last_name." ".$booking_vehicle_first_name).',<p>';
	$data_html .='<p> Thank you for booking.</p>';

	mail_format_and_send_process($subject,$data_html,$booking_vehicle_email,$cc_mail,$bcc_mail);
}
?>

<!-- New Post Form -->
<div id="postbox">
<form id="booking_vehicle_new_post" name="booking_vehicle_new_post" method="post" action="">

<!-- post name -->
<p><label for="title">Title</label><br />
<input type="text" id="booking_vehicle_title" value="" tabindex="1" size="20" name="booking_vehicle_title" />
</p>

<!-- post Category -->
<?php /*?><p><label for="Category">Category:</label><br />
<p><?php wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=category' ); ?></p><?php */?>



</p>

<p><label for="booking_vehicle_label_first_name">First name:</label>
<input type="text" value="" tabindex="5" size="16" name="booking_vehicle_first_name" id="booking_vehicle_first_name" /></p>

<p><label for="booking_vehicle_label_last_name">Last name:</label>
<input type="text" value="" tabindex="5" size="16" name="booking_vehicle_last_name" id="booking_vehicle_last_name" /></p>

<p><label for="booking_vehicle_label_email">Email:</label>
<input type="text" value="" tabindex="5" size="16" name="booking_vehicle_email" id="booking_vehicle_email" /></p>

<p><label for="booking_vehicle_label_phone">Phone:</label>
<input type="text" value="" tabindex="5" size="16" name="booking_vehicle_phone" id="booking_vehicle_phone" /></p>


<!-- post Category -->
<p><label for="booking_vehicle_category_list">Vehicle Category:</label><br />
<p><?php wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=category' ); ?></p>


<!-- post -->
<p><label for="booking_vehicle_post_list">Vehicle:</label><br />
<p><?php $args=array(

            'show_option_none'  => 'Select Vehicle',
            'post_type'         => $post_type,
            'name'              => $name,
            'selected'          => $selected_id,
            'echo'              => true
   );

    booking_vehicle_get_dropdown_posts($args);  ?></p>
    
<p><label for="booking_vehicle_label_price">Vehicle Price :</label>
<input type="text" value="" tabindex="5" size="16" name="booking_vehicle_price" id="booking_vehicle_price" /></p>


<!-- post Content -->
<p><label for="booking_vehicle_description">Message</label><br />
<textarea id="booking_vehicle_description" tabindex="3" name="booking_vehicle_description" cols="50" rows="6"></textarea>

<p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

<input type="hidden" name="action" value="booking_vehicle_new_post" />
<?php wp_nonce_field( 'new-post' ); ?>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

jQuery(document).ready(function($) {
  jQuery('#_select').on('change', function() {
    var post_id = jQuery(this).val();
    alert(post_id);
  });
});
</script>
</div>

    <?php
}
function get_price($post_id){
	$price= esc_html( get_post_meta(acc, 'post_price', true ) );
	return $price;
}
//echo do_shortcode( 'booking_vehicle_form' );

function booking_vehicle_get_dropdown_posts( $args = array( 'post_type' => 'post', 'show_option_none'  => 'Select a post', 'name' => null, 'selected' => '', 'echo' => true ) ){

    $posts = get_posts(
        array(
            'post_type'  => $args['post_type'],
            'numberposts' => -1
        )
    );

    $dropdown = '';

    if( $posts ){

        if( !is_string($args['name']) ){

            $args['name'] = $args['post_type'].'_select';
        }

        $dropdown .= '<select id="'.$args['name'].'" name="'.$args['name'].'">';

            $dropdown .= '<option value="-1">'.$args['show_option_none'].'</option>';

            $args['selected'] = intval($args['selected']);

            foreach( $posts as $p ){

                $selected = '';
                if( $p->ID == $args['selected'] ){

                    $selected = ' selected';
                }

                $dropdown .= '<option value="' . $p->ID . '"'.$selected.'>' . esc_html( $p->post_title ) . '</option>';
            }

        $dropdown .= '</select>';           
    }

    if($args['name'] === false){

        return $dropdown;
    }
    else{

        echo $dropdown;
    }
}
?>