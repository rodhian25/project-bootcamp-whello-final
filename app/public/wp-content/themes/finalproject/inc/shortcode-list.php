<?php

/* -------------------------------
      Shortcode Layout
----------------------------------
 */
function layout($atts)
{
  ob_start();
  extract(shortcode_atts(
    array(
      'layout_id' => '',
    ),
    $atts
  ));

  $get_layout = get_post($layout_id);
  $content =  $get_layout->post_content;
  $content =  apply_filters('the_content', $content);
  wp_reset_postdata();

  echo $content;
  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode('layout', 'layout');





/*-------------------------------------
	Shortcode listing event post
---------------------------------------*/
function listing($atts)
{
  ob_start();
  extract(shortcode_atts(
    array(
      'post_type' => '',
      'posts_per_page' => '',
      'orderby' => '',
      'order' => '',
      'post_status' => '',
      'reader' => '',
      'category_id' => '',
      'taxonomy' => 'event_cat',
      'terms' => '',
      'extra_class' => '',
      'input' => '',
    ),
    $atts
  ));

  if (is_front_page()) {
    $test = 'page';
  } else {
    $test = 'paged';
  }
  $paged = (get_query_var($test)) ? get_query_var($test) : 1;
  $args = array(
    'orderby' => $orderby,
    'order' => $order,
    'post_status' => $post_status,
    'paged' => $paged,
  );


  /*-------------------------------------
    condition
  ---------------------------------------*/
  // post-type
  if (!empty($post_type)) {
    $post_type = explode(",", $post_type);
    $args['post_type'] = $post_type;
  }

  //posts-per-page
  if (!empty($posts_per_page)) {
    if (is_string($posts_per_page)) {
      $args['posts_per_page'] = '-1';
    }
    $args['posts_per_page'] = $posts_per_page;
  }


  // category post
  if (!empty($category_id)) {
    $args['cat'] = $category_id;
  }

  // reader
  if (!empty($reader)) {
    $reader = explode(",", $reader);
    $args['meta_query'] = array(
      array(
        'key' => 'reader',
        'value'    => $reader,
      ),
    );
  }

  //taxonomy category event
  if (!empty($taxonomy) && !empty($terms)) {
    $terms = explode(",", $terms);
    $args['tax_query'] = array(
      array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $terms,
      ),
    );
  }

  //search
  if (!empty($input)) {
    $args['s'] = $input;
  }


  /*mengubah post type sebelumnya yang sudah menjadi array
  untuk kondisi menampilkan location event*/
  $post_tipe = implode(',', $post_type);

  // The Query
  $query = new WP_Query($args);

  // The Loop
  if ($query->have_posts()) {
?>
    <div class="listing-wrapper <?php echo $extra_class ?> archive-listing-wrapper">
      <?php
      while ($query->have_posts()) {
        $query->the_post();
        $title = get_the_title();
        $url = get_the_permalink();
        $desc_post = wp_trim_words(get_the_excerpt(), 15, "...");
        $desc_event = wp_trim_words(get_the_excerpt(), 10, "");
        $result_location = get_field('location', get_the_ID());
        //condition to display img thumbnail post not found
        if (has_post_thumbnail()) {
          $image = get_the_post_thumbnail("", "full");
        } else {
          $image = wp_get_attachment_image(127, "full");
        }
      ?>
          <div class="listing-items">
            <a href="<? echo $url ?>">
              <div class="listing-items-thumbnail">
                <? echo $image ?>
              </div>
              <div class="listing-items-content">
                <h3><? echo $title ?></h3>
                <?php
                if ($post_tipe == 'event') : ?>
                  <p class='location-event'><?php echo $result_location ?></p>
                  <p><?php echo $desc_event ?></p>
                <?php else : ?>
                  <p><?php echo $desc_post ?></p>
                <?php endif; ?>
              </div>
            </a>
            <a href="<? echo $url ?>" class="read-more">
              <!-- condition diferent read more to post stc, and see detail to event -->
              <?php if ($post_tipe == 'event') : echo 'See details ->';
              else : echo 'Read More ->';
              endif; ?>
            </a>
          </div>
      <?php
      }
      ?>
    </div>
<?php
  } else {
    // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode('listing', 'listing');



?>