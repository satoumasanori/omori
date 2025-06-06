<?php
// Function to get post views
function get_post_views( $postID ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '1' );
        return 1;
    }
    return $count;
}

// Function to set/increment post views
function set_post_views( $postID ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        $count = 1;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '1' );
    } else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}


function get_today_events_query() {
  date_default_timezone_set('Asia/Tokyo');
  $today = date('Y-m-d');

  return new WP_Query(array(
    'post_type'      => 'tribe_events',
    'posts_per_page' => -1,
    'meta_query'     => array(
      array(
        'key'     => '_EventStartDate',
        'value'   => $today,
        'compare' => 'LIKE',
      ),
    ),
    'orderby'        => 'meta_value',
    'meta_key'       => '_EventStartDate',
    'order'          => 'ASC',
  ));
}

// function enqueue_event_calendar_script() {
  
  wp_enqueue_script(
    'event-calendar',
    get_stylesheet_directory_uri() . '/assets/js/event_calendar.js',
    array(),
    null,
    true
  );
  
  wp_localize_script('event-calendar', 'eventCalendar', array(
    'ajaxUrl' => admin_url('admin-ajax.php')
  ));
  error_log('enqueue_event_calendar_script is running');
// }
// add_action('wp_enqueue_scripts', 'enqueue_event_calendar_script');

function my_theme_enqueue_styles() {
  wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
// AJAX handler
// Ajax handler for loading events based on range
function load_events_callback() {
    // Sanitize input
    $range = isset($_GET['range']) ? sanitize_text_field($_GET['range']) : 'day';
    $date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
    $timestamp = strtotime($date);
    
    switch ($range) {
        case 'week':
            // Calculate Monday and Sunday of that week based on $date
            $start_date = date('Y-m-d', strtotime('monday this week', $timestamp));
            $end_date = date('Y-m-d', strtotime('sunday this week', $timestamp));
            break;
        case 'month':
            $start_date = date('Y-m-01', $timestamp);
            $end_date = date('Y-m-t', $timestamp);
            break;
        case 'day':
        default:
            $start_date = $date;
            $end_date = $date;
            break;
    }
    // Build the query args for events between $start_date and $end_date
    $args = array(
      'post_type'      => 'tribe_events',
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'meta_query'     => array(
          array(
              'key'     => '_EventStartDate',
              'value'   => array($start_date . ' 00:00:00', $end_date . ' 23:59:59'),
              'compare' => 'BETWEEN',
              'type'    => 'DATETIME'
          )
      ),
      'orderby'    => 'meta_value',
      'order'      => 'ASC',
      'meta_key'   => '_EventStartDate',
  );

    $events = new WP_Query($args);

    if ($events->have_posts()) :
        while ($events->have_posts()) : $events->the_post();
            $post_id    = get_the_ID();
            $start_date = get_post_meta($post_id, '_EventStartDate', true);
            $time       = tribe_get_start_time();
            $venue      = tribe_get_venue();
            $desc       = get_the_excerpt();
            $date_obj   = new DateTime($start_date);

            $img_url = get_the_post_thumbnail_url($post_id, 'medium');
            if (!$img_url) {
                $content = get_post_field('post_content', $post_id);
                preg_match('/<img[^>]+src="([^">]+)"/i', $content, $matches);
                $img_url = $matches[1] ?? get_template_directory_uri() . '/assets/img/default.jpg';
            }
            ?>
            <?php if ($range === 'day') : ?>
              <div class="event-card swiper-slide">
              <!-- <a href="<?php echo get_permalink($post_id); ?>"> -->

            <?php elseif ($range === 'week' || $range ==='month') : ?>
              <div class="event-card">
              <a href="<?php echo get_permalink($post_id); ?>">
            <?php endif; ?>
            <?php if($range === 'day' || $range ==='week') : ?>
              <div class="event-card-img">
                <img src="<?= esc_url($img_url); ?>" alt="Event Image">
                <div class="pink-dot"></div>
                <div class="date">
                  <p><?= $date_obj->format('m.d'); ?></p>
                  <span><?= $date_obj->format('Y'); ?><br><?= strtoupper($date_obj->format('D')); ?></span>
                </div>
              </div>
              <?php endif ;?>
              <div class="event-card-text">

                <?php if($range === 'day' || $range === 'week') : ?>
                  <div class="title"><?= get_the_title(); ?></div>
                  <div class="info">
                    時間: <?= esc_html($time); ?> <span>|</span>場所: <?= esc_html($venue); ?>
                  </div>
                <?php else : ?>
                  <div class="date">
                  <p><?= $date_obj->format('m.d'); ?></p>
                </div>
                <div class="title"><?= get_the_title(); ?></div>
                <?php endif; ?>
                <?php if ($range === 'day') : ?>
                  <div class="contents">
                    <p><?= esc_html($desc); ?></p>
                  </div>
                <?php endif; ?>
              </div>
                <!-- </a> -->
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>指定期間のイベントはありません。</p>';
    endif;

    wp_die(); // important to end Ajax handler properly
}
add_action('wp_ajax_load_events', 'load_events_callback');
add_action('wp_ajax_nopriv_load_events', 'load_events_callback');

