
<?php

defined ('ABSPATH') or die ('No scripts kiddies please!');
if (! Defined ('ABSPATH')) exit; // Sair se acessado diretamente

add_filter('widget_text', 'do_shortcode');