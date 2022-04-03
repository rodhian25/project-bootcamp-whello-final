<?php
add_shortcode('filter', 'filter');
function filter()
{
  ob_start();
  $reader = get_field_object("reader");
  $readers = $reader['choices'];
  $terms = get_terms('category');

  if ('event' == get_post_type()) {
    echo '<select class="form-select checkboxbook my-2 select" aria-label="Default select example" id="selectorder">';
    echo '<option value="">Select Reader</option>';
    foreach ($readers as $key => $value) {
      echo "<option value='$key'>$key</option>";
    }
    echo '</select>';
  } else {
    echo '<select class="form-select checkboxbook my-2 select" aria-label="Default select example" id="selectorder">';
    echo '<option value="">Select Category</option>';
    foreach ($terms as $key) {
      echo "<option value='$key->value'>$key->name</option>";
    }
    echo '</select>';
  }
?>
  <input class="select" id="search" type="text" placeholder="input the min 4 word to the search" required>

<?php
  return ob_get_clean();
}
?>

<?php
add_action('wp_footer', function () {
?>
  <script>
    jQuery(document).ready(function($) {
      var ajaxUrl = '<?php echo admin_url("admin-ajax.php") ?>';

      function testajax(data) {
        $.ajax({
          url: ajaxUrl,
          type: 'POST',
          data: data,
          beforeSend: function() {
            jQuery('.archive-listing-wrapper').hide();
            jQuery('.sk-fading-circle').show();
          },
          success: function(response) {
            jQuery('.sk-fading-circle').hide();
            jQuery('.archive-listing-wrapper').show();
            jQuery('.archive-listing-wrapper').html(response);
          },
          error: function() {
            console.log("error");
          },
          complete: function() {
            // console.log("ok");
          }

        })
      };
      jQuery('.select').change(function() {
        var tipe = $().val();
        var order = $("#selectorder").val();
        var input = $("#search").val();
        var data = {
          'action': 'filter',
          'select': order,
          'input': input,
        }
        testajax(data);
      });
      jQuery('#search').on('keyup', function() {
        var order = $("#selectorder").val();
        var input = $("#search").val();
        if (input.length >= 4) {
          var data = {
            'action': 'filter',
            'select': order,
            'input': input,
          }
        } else {
          var data = {
            'action': 'filter',
            'select': order,
            'input': '',
          }
        }
        testajax(data);
      });
    })
  </script>

<?php
});
add_action('wp_ajax_filter', 'filter_passing');
add_action('wp_ajax_nopriv_filter', 'filter_passing');

function filter_passing()
{
  $select = $_POST['select'];
  $input = $_POST['input'];
  echo do_shortcode('[listing post_type="event" reader="' . $select . '" input="' . $input . '" ]');
  wp_die();
}
