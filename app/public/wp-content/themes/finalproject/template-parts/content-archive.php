<?php
$post_tipe = get_post_type();
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

