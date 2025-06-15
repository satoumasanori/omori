<?php
get_header();

$event_id = isset($_GET['event_id']) ? absint($_GET['event_id']) : 0;
if (!$event_id) {
  echo '<p>イベントが見つかりません。</p>';
  get_footer();
  exit;
}

$title      = get_the_title($event_id);
$start_date = get_post_meta($event_id, '_EventStartDate', true);
$time       = function_exists('tribe_get_start_time') ? tribe_get_start_time($event_id) : '';
$venue      = function_exists('tribe_get_venue') ? tribe_get_venue($event_id) : '';
$excerpt    = get_the_excerpt($event_id);
$content    = apply_filters('the_content', get_post_field('post_content', $event_id));
$image = get_the_post_thumbnail_url($event_id, 'medium');
$event_subtitle_up = get_post_meta($event_id, '_ecp_custom_2', true);
$event_detail_up = get_post_meta($event_id, '_ecp_custom_3', true);
$event_subtitle_down = get_post_meta($event_id, '_ecp_custom_4', true);
$event_detail_down = get_post_meta($event_id, '_ecp_custom_5', true);

if (!$image) {
  // fallback: try to get the first image from post content
  $content_raw = get_post_field('post_content', $event_id);
  preg_match('/<img[^>]+src="([^">]+)"/i', $content_raw, $matches);
  $image = $matches[1] ?? get_template_directory_uri() . '/assets/img/default.jpg';
}
?>

<section class="event-firstview firstview">
  <div class="event-f-left f-left">
    <div class="f-to-event">
    
      <div class="section-title">
        <span class="blue">E</span><span class="pink">v</span><span class="yellow">e</span><span class="black">n</span><span class="blue">t</span>
      </div>
      <div class="event-title"><?= esc_html($title); ?></div>
      <div class="f-event-content">
        <div class="info">
          <p>INFORMATION</p><div></div>
        </div>
        <p>
          <time datetime="<?= esc_attr($start_date); ?>">
            時間: <?= esc_html($time); ?>
          </time>
          | 場所: <?= esc_html($venue); ?>
        </p>
        <h3><?= esc_html($excerpt); ?></h3>
      </div>
    </div>
  </div>
  <div class="event-f-right">
    <div class="event-f-right-img">
      <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>">
    </div>
    <div class="f-right-link">
      <a href="<?= esc_url(home_url()); ?>"><p>TOP</p><span>></span><p><?= esc_html($title); ?></p></a>
    </div>
  </div>
</section>

<section class="event-content">
  <img src="<?= esc_url(get_stylesheet_directory_uri()); ?>/assets/img/Rectangle 85.png" class="pink-shape" alt="">
  <img src="<?= esc_url(get_stylesheet_directory_uri()); ?>/assets/img/Rectangle 84.png" class="blue-shape" alt="">

  <div class="event-content-text">
    <h2><?= $event_subtitle_up ?></h2>
    <p><?= $event_detail_up ?></p>
  </div>

  <div class="event-content-img">
    <img src="<?= esc_url($image); ?>" alt="Event Image">
  </div>

  <div class="event-content-text">
    <h3><?= $event_subtitle_down ?></h3>
    <p><?= $event_detail_down ?></p>
  </div>


  <div class="event-content-btn">
    <a href="<?= esc_url(home_url()); ?>"><button>TOPへ戻る</button></a>
  </div>
</section>

<?php get_footer(); ?>
