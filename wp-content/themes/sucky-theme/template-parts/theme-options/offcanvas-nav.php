<?php

// TODO: if offcanvas_position is either top or bottom, set navbar-nav to d-md-flex flex-row

// TODO: add home button / link / logo to offcanvas (option for any)

// TODO: forego dark variant for custom color variant (both offcanvas and default, add inline styles to control dropdown, separate into its own file to reference?)

// TODO: responsive-only variant

// TODO: add image size constraints in acf field

$offcanvas_options_group = get_field('offcanvas_options_group', 'option'); // group

$offcanvas_main_title = $offcanvas_options_group['offcanvas_main_title'];
$offcanvas_custom_main_title_color = $offcanvas_options_group['offcanvas_custom_main_title_color'];

$offcanvas_position = $offcanvas_options_group['offcanvas_position']['value'];
$offcanvas_scrolling_options = $offcanvas_options_group['offcanvas_scrolling_options']; // select dropdown
$offcanvas_responsive_activate = $offcanvas_options_group['offcanvas_responsive_activate'];
$offcanvas_breakpoints = $offcanvas_options_group['offcanvas_breakpoints'];

$offcanvas_use_icon = $offcanvas_options_group['offcanvas_use_icon'] ? $offcanvas_options_group['offcanvas_use_icon'] : false; // true / false

$offcanvas_button_group = $offcanvas_options_group['offcanvas_button_group']; // group

$offcanvas_button_label =  $offcanvas_button_group['offcanvas_button_label'];

$offcanvas_icon =  $offcanvas_button_group['offcanvas_icon'];

$nav_customize_colors = get_field('nav_customize_colors', 'option');

/**
 * position logic [*]
 * 
 * positions:
 *   top : Top
     end : Right
     bottom : Bottom
     start : Left
 */

/**
 * scrolling logic (make sure to add aria-controls to the menu button if this is active!)
 * 
 * options: [*]
 *   enable_bodyscroll : Body scrolling enabled
     enable_backdrop : Backdrop enabled (without body scrolling, default)
     enable_both : Both backdrop and body scrolling enabled
     enable_static : No scrolling, nav will not close when clicking outside
 */

$position_class = '';
switch ($offcanvas_position) {
    case 'top':
        $position_class .= 'offcanvas-top';
        break;
    case 'end':
        $position_class .= 'offcanvas-end';
        break;
    case 'bottom':
        $position_class .= 'offcanvas-bottom';
        break;
    case 'start':
        $position_class .= 'offcanvas-start';
        break;
    default:
        return;
        break;
}

// offcanvas on mobile by default 
$row_class = '';
if($offcanvas_position === 'top' || $offcanvas_position ===  'bottom') {
    $row_class .= 'd-md-flex justify-content-start flex-md-row '; // make sure to style li children in the offcanvas nav sass
}

// responsive breakpoints
/**
 * sm : Small screens (540px and smaller)
   md : Medium screens (720px and smaller)
   lg : Large screens (960px and smaller)
   xl : Extra large screens (1140px and smaller)
   xxl : Larger format screens (1320px and smaller)
 */


$responsive_class = 'offcanvas-' . $offcanvas_breakpoints['value'];


// var_dump($responsive_class);

$controls_array = array(
    'enable_bodyscroll'     =>  'data-bs-scroll="true" data-bs-backdrop="false"',
    'enable_both'           =>  'data-bs-scroll="true"',
    'enable_static'         =>  'data-bs-backdrop="static"',
);

// === accessibility note === https://getbootstrap.com/docs/5.2/components/offcanvas/#accessibility
/**
 * Since the offcanvas panel is conceptually a modal dialog, be sure to add aria-labelledby="..."-—referencing the offcanvas title--to .offcanvas. Note that you don’t need to add role="dialog" since Bootstrap already adds it via JavaScript.
 * 
 * Heads up! Given how CSS handles animations, you cannot use margin or translate on an .offcanvas element. Instead, use the class as an independent wrapping element.
 */


?>

<button <?php
        foreach($controls_array as $control):
            echo 'aria-controls="offcanvasNav"';
        endforeach;
    ?> class="btn <?php if ($offcanvas_responsive_activate): echo 'd-' . $offcanvas_breakpoints['value'] . '-none'; endif; ?>
    <?php 
        if (!$offcanvas_icon) : echo " btn-primary";
    endif; ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav"
 <?php if ($offcanvas_icon) {
     echo 'aria-label="' . $offcanvas_button_label . '"';
 }?>>

 <?php
    if ($offcanvas_use_icon && !$offcanvas_icon) :
        echo $offcanvas_button_label;
    elseif ($offcanvas_use_icon && $offcanvas_icon) :
        echo '<img src="' . $offcanvas_icon . '" alt="" />';
    else :
        echo 'Menu';
    endif;
    ?>

</button>

<?php if($offcanvas_responsive_activate) {?>

    <nav class="navbar navbar-expand-<?php echo $offcanvas_breakpoints['value']; ?> d-none d-<?php echo $offcanvas_breakpoints['value']; ?>-flex">
        <?php include(get_template_directory() . '/template-parts/theme-options/default-nav.php'); ?>
    </nav>

    <div class="offcanvas d-<?php echo $offcanvas_breakpoints['value']; ?>-none <?php echo ($responsive_class); ?>
        <?php echo $position_class; ?>" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel" <?php
            foreach($controls_array as $control => $option):
                if($offcanvas_scrolling_options['value'] === $control):
                    echo $option;
                endif;
            endforeach;
        ?>>
    <div class="offcanvas-header d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container">
        
        <h5 class="offcanvas-title" id="offcanvasNavLabel" style="color: <?php echo $offcanvas_custom_main_title_color; ?>;">
          <a href="<?php echo esc_html(home_url('/')); ?>" rel="home" style="color: inherit;">
            <?php echo $offcanvas_main_title; ?>
          </a>
        </h5>

        <div class="offcanvas-body" id="offcanvas-menu">
        <!-- regular wp nav stuff here -->
        <?php
            include(get_template_directory() . '/template-parts/theme-options/menu.php');
        ?>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="offcanvas <?php echo $position_class; ?>" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel" <?php
            foreach($controls_array as $control => $option):
                if($offcanvas_scrolling_options['value'] === $control):
                    echo $option;
                endif;
            endforeach;
        ?>>
    <div class="offcanvas-header d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="container">
        <h5 class="offcanvas-title" id="offcanvasNavLabel">
        <?php echo $offcanvas_main_title; ?>
        </h5>

        <div class="offcanvas-body" id="offcanvas-menu">
        <!-- regular wp nav stuff here -->
        <?php
            include(get_template_directory() . '/template-parts/theme-options/menu.php');
        ?>
        </div>
    </div>
</div>
<?php } ?> 
