<?php

/*-------------------------------------
	Listing event
---------------------------------------*/
function listings()
{

  /* ------------------------
    mendapatkan semua post_type
  ---------------------------
  */
  $post_types = get_post_types(
    array(
      'public' => true,
    ),
    'objects'
  );
  // remove attachment from the list
  unset($post_types['attachment']);
  unset($post_types['layout']);
  $posts = array();
  foreach ($post_types as $post_type) {
    $posts[$post_type->name] = $post_type->name;
  }


  /* ------------------------
    mendapatkan semua kategori post
  ---------------------------
  */
  $category_post = array();
  foreach (get_categories() as $cat_post) {
    $category_post[$cat_post->name] = $cat_post->term_id;
  }


  /* ------------------------
    mendapatkan semua kategori event
  ---------------------------
  */
  $category_event = array();
  $taxonomies = get_terms('event_cat');
  foreach ($taxonomies as $taxonomys) {
    $category_event[$taxonomys->name] = $taxonomys->name;
  }


  /* ------------------------
    mendapatkan semua status
  ---------------------------
  */
  $status_posts = array_reverse(array_flip(get_post_statuses()));

  vc_map(array(
    "name" => __("Listings", "bakerybootcamp"),
    "base" => "listing",
    "category" => __("whello element", "bakerybootcamp"),
    "icon" => "icon-wpb-application-icon-large",
    "description" => __("display listings event, post or page, etc", "bakerybootcamp"),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Choose Post Type", "bakerybootcamp"),
        "param_name" => "post_type",
        "value" => $posts,
        "description" => __("choose post type you want to display (example: 'event', 'post', 'page', or check all)", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "dropdown_multi",
        "heading" => __("Choose Category Event", "bakerybootcamp"),
        "param_name" => "terms",
        "value" => $category_event,
        "dependency" => array('element' => 'post_type', 'value' => 'event'),
        "description" => __("choose category event you can one checked or other", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "dropdown_multi",
        "heading" => __("Choose Category Post", "bakerybootcamp"),
        "param_name" => "category_id",
        "value" => $category_post,
        "dependency" => array('element' => 'post_type', 'value' => 'post'),
        "description" => __("choose category post you can one checked or other", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "textfield",
        "heading" => __("Posts Per Page", "bakerybootcamp"),
        "param_name" => "posts_per_page",
        "value" => "",
        "description" => __("how many total post in per page, if you want display all posts, then you type '-1' without quotes", "bakerybootcamp"),
        "edit_field_class" => "vc_col-sm-3",
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Order By", "bakerybootcamp"),
        "param_name" => "orderby",
        "value" => array("NONE" => "none", "DATE" => "date", "RAND" => "rand", "TITLE" => "title", "POST ID" => "ID", "TYPE" => "type", "MODIFIED" => "modified", "COMMENT" => "comment_count"),
        "edit_field_class" => "vc_col-sm-3",
        "description" => __("post will in order by example(date, title)", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Order", "bakerybootcamp"),
        "param_name" => "order",
        "value" => array("Ascending (A-Z)" => "ASC", "Descending (Z-A)" => "DESC"),
        "description" => __("post order in Ascending (ASC) or Descending (DESC)", "bakerybootcamp"),
        "edit_field_class" => "vc_col-sm-4",
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Post Status", "bakerybootcamp"),
        "param_name" => "post_status",
        "value" => $status_posts,
        "dependency" => array('element' => 'post_type', 'value' => array("page", "post")),
        "description" => __("status post example(publish, draft)", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "checkbox",
        "heading" => __("Reader Gender", "bakerybootcamp"),
        "param_name" => "reader",
        "value" => array("FEMALE" => "female", "MALE" => "male"),
        "description" => __("post display in accordance with the reader example (female, male)", "bakerybootcamp"),
        "dependency" => array('element' => 'post_type', 'value' => "event"),
        "admin_label" => true,
        "save_always" => true,
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "bakerybootcamp"),
        "param_name" => "extra_class",
        "value" => "",
        "edit_field_class" => "vc_col-sm-9",
        "description" => __("if you want add extra class style css", "bakerybootcamp"),
        "admin_label" => true,
        "save_always" => true,
      ),
    ),
  ));
}
add_action("vc_before_init", "listings");










/*---------------------------------------
    create new select multiple type
-----------------------------------------
*/
// Create multi dropdown param type
vc_add_shortcode_param('dropdown_multi', 'dropdown_multi_settings_field', get_template_directory_uri() . '/js/vc_extend/multiple-select.js');

function dropdown_multi_settings_field($param, $value)
{
  $param_line = '';
  $param_line .= '<select multiple name="' . esc_attr($param['param_name']) . '" class="bakery-multiple wpb_vc_param_value wpb-input wpb-select ' . esc_attr($param['param_name']) . ' ' . esc_attr($param['type']) . '">';
  foreach ($param['value'] as $text_val => $val) {
    if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
      $text_val = $val;
    }
    $text_val = __($text_val, "bakerybootcamp");
    $selected = '';

    if (!is_array($value)) {
      $param_value_arr = explode(',', $value);
    } else {
      $param_value_arr = $value;
    }

    if ($value !== '' && in_array($val, $param_value_arr)) {
      $selected = ' selected="selected"';
    }
    $param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
  }
  $param_line .= '</select>';

  return  $param_line;
}



?>