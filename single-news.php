<?php
get_header();
?>
<?php set_post_views(get_the_ID()); ?>
<section class="event-firstview firstview">
  <div class="f-left event-f-left">
    <div class="f-to-event">
      <div class="section-title">
        <span class="blue">N</span>
        <span class="pink">e</span>
        <span class="yellow">w</span>
        <span class="black">s</span>
      </div>
      <div class="event-title">ニュース</div>
      <div class="f-event-content">
        <h3><?php echo get_the_title(); ?></h3>
      </div>
    </div>
  </div>
  <div class="event-f-right">
    <div class="question-f-right-img">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" alt="">
    </div>
    <div class="f-right-link">
      <p>TOP</p><span>></span>
      <p>ニュース</p>
    </div>
  </div>
</section>

<section class="event-content">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 85.png" class="pink-shape" alt="">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 84.png" class="blue-shape" alt="">
  <div class="event-content-pic-part">
    <div class="event-content-pic-part-img">
      <?php
      $image = get_field('news_img');
      if ($image) {
        $url = $image['url'];
        $alt = $image['alt'];
        echo '<img src="' . $url . '" alt="' . $alt . '" />';
      }
      ?>
    </div>
    <div class="event-content-pic-part-text">
      <p><?php echo get_the_content(); ?></p>
    </div>
  </div>
  <div class="event-content-btn">
    <a href="/news"><button>ニュース一覧に戻る</button></a>
  </div>
</section>

<?php get_footer(); ?>