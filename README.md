# This is a readme for the custom theme 'This Theme Sucks'!

## A note on the use of child themes

In general, you need to avoid adding custom posts and custom post and UI plugins to a theme you plan on shipping to the world at large. Save those parts for when you're building your site in WordPress! In this specific case, the theme is being used for personal sandbox purposes. Keep these guidelines in mind if you use this theme yourself!

## Customizing parent theme files

When you need to customize theme files that are shipped with the parent theme, be sure to copy them from the parent to the child and replace `include(get_template_directory())` with `require_once get_stylesheet_directory` for file paths, and `require_once get_stylesheet_directory_uri()` for url paths (useful for images and frontend assets!). ***ONLY DO THIS FOR FILES YOU INTEND TO CUSTOMIZE.*** For more information, check out the [WordPress guide to using child themes](https://developer.wordpress.org/themes/advanced-topics/child-themes/#referencing-or-including-other-files). 