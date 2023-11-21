<div class="container-fluid">
  <div class="site-branding">
    <?php
      if (is_front_page() && is_home()) :
      the_custom_logo();
      ?>
    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
    </h1>
    <?php else : ?>
      <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
          <?php bloginfo('name'); ?>
      </a>
    <?php endif; ?>
  </div><!-- .site-branding -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu"
    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="main-menu">
    <?php
          include(get_template_directory() . '/template-parts/theme-options/menu.php');
      ?>
  </div>
</div>