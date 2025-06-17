<<<<<<< HEAD
<?php 
function meu_script_overlay_postx() { 
?>
<style>
.ultp-block-image .ultp-block-title a {
    color: white !important;
    text-decoration: none;
}

.ultp-block-image .ultp-block-title a:hover,
.ultp-block-image .ultp-block-title a:visited,
.ultp-block-image .ultp-block-title a:focus {
    color: white !important;
}
</style>

<script>
jQuery(document).ready(function($) {
    $('.ultp-block-item').each(function() {
=======
<?php
function meu_script_overlay_postx() {
  ?>
<script>
    jQuery(document).ready(function($) {
      $('.ultp-block-item').each(function() {
>>>>>>> ca06605b91a6bfd8b1b0c4af1d6a219619db7b2f
        var $item = $(this);
        var $imageContainer = $item.find('.ultp-block-image');
        var $image = $imageContainer.find('img');
        var $title = $item.find('.ultp-block-title');
<<<<<<< HEAD
        var $link = $title.find('.ultp-component-simple, a');
        
        if ($imageContainer.length && $title.length) {
          
            $imageContainer.css('position', 'relative');
            $title.appendTo($imageContainer);
            
            $title.css({
                'position': 'absolute',
                'bottom': '10px',
                'left': '10px',
                'padding': '0.5rem',
                'z-index': '10',
                'max-width': '90%',
                'background': 'transparent',
                'text-decoration': 'none',
                'transition': 'all 0.3s ease'
            });
            
            $link.css({
                'color': 'white !important',
                'text-decoration': 'none'
            });
            
            $title.hover(
                function () {
                    $(this).css('border-bottom', '1px solid white');
                },
                function () {
                    $(this).css('border-bottom', '1px solid transparent');
                }
            );
        }
    });
});
</script>
<?php 
} 
add_action('wp_footer', 'meu_script_overlay_postx');
?>
=======
		    var $link = $title.find('.ultp-component-simple'); 
 
		  
        if ($imageContainer.length && $title.length) {
          $image.css({
            'opacity': 'o.4', 
            'transition': 'opacity 0.3s ease'
          });
          $imageContainer.css('position', 'relative');
          $title.appendTo($imageContainer);
          $title.css({
            'position': 'absolute',
            'bottom': '10px',
            'left': '10px',
            'padding': '0.5rem',
            'z-index': '10',
            'max-width': '90%',
            'background': 'transparent',
            'text-decoration': 'none',
            'transition': 'all 0.3s ease',
          });
          $title.hover(
       function () {
              $(this).css('border-bottom', '1px solid white');
            },
            function () {
              $(this).css('border-bottom', '1px solid transparent');
            }
          );
        }
      });
    });
</script>
<?php
}
add_action('wp_footer', 'meu_script_overlay_postx');
;
>>>>>>> ca06605b91a6bfd8b1b0c4af1d6a219619db7b2f
