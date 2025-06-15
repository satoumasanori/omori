<?php
get_header();
?>
<?php set_post_views(get_the_ID()); ?>
<section class="event-firstview firstview">
  <div class="f-left event-f-left">
    <div class="f-to-event">
      <div class="section-title">
        <span class="blue">P</span>
        <span class="pink">i</span>
        <span class="yellow">c</span>
        <span class="black">t</span>
        <span class="blue">u</span>
        <span class="pink">r</span>
        <span class="black">e</span>
        <span class="space">　</span>
        <span class="blue">B</span>
        <span class="pink">o</span>
        <span class="yellow">o</span>
        <span class="black">k</span>
      </div>
      <div class="event-title">大森図鑑</div>
      <div class="f-event-content">
        <h3>地域で活躍する<br>素敵な人々を紹介します</h3>
      </div>
    </div>
  </div>
  <div class="event-f-right">
    <div class="event-f-right-img">
      <?php
      $image = get_field('pic-card-img');
      if ($image) {
        $url = $image['url'];
        $alt = $image['alt'];
        echo '<img src="' . $url . '" alt="' . $alt . '" />';
      }
      ?>
    </div>
    <div class="f-right-link">
      <p>TOP</p><span>></span>
      <p>大森図鑑</p>
    </div>
  </div>
</section>
<section class="event-content">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 85.png" class="pink-shape" alt="">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 84.png" class="blue-shape" alt="">
  <div class="event-content-pic-part">
    <div class="event-content-pic-part-img">
      <?php
      $image = get_field('pic-card-img');
      if ($image) {
        $url = $image['url'];
        $alt = $image['alt'];
        echo '<img src="' . $url . '" alt="' . $alt . '" />';
      }
      ?>
    </div>
    <div class="event-content-pic-part-text">
      <h2>
        <?php echo get_the_title(); ?><span><?php echo get_post_meta(get_the_ID(), "pic-category", true); ?></span>
      </h2>
      <p><?php echo get_post_meta(get_the_ID(), "pic-card-desc", true); ?></p>
    </div>
  </div>
  <div class="event-content-text">
    <h3><?php echo get_post_meta(get_the_ID(), "pic-desc-title", true); ?></h3>
    <p><?php echo get_post_meta(get_the_ID(), "pic-sub-desc1", true); ?></p>
    <p><?php echo get_post_meta(get_the_ID(), "pic-sub-desc2", true); ?></p>
  </div>
  <div class="event-content-btn">
    <a href="<?php echo home_url(); ?>"><button>TOPへ戻る</button></a>
  </div>
</section>

<?php
get_footer();
?>