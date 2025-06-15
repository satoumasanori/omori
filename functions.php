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

function custom_event_rewrite_rule() {
  add_rewrite_rule('^event/([0-9]+)/?', 'index.php?pagename=event-detail&event_id=$matches[1]', 'top');
}
add_action('init', 'custom_event_rewrite_rule');

/**
* Add custom query variable 'event_id' so we can read it on the target page.
*/
function custom_event_query_vars($vars) {
  $vars[] = 'event_id';
  return $vars;
}
add_filter('query_vars', 'custom_event_query_vars');

function custom_event_flush_rewrite() {
  custom_event_rewrite_rule();
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'custom_event_flush_rewrite');

// Utility: Query today's events
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

// Disable Events Calendar default styles and scripts
add_filter('tribe_events_kill_ajax_on_load', '__return_true');
add_filter('tribe_events_stylesheet_url', '__return_false');
add_filter('tribe_events_kill_styles_and_js', '__return_true');

// Force custom template for single 

add_filter('single_template', function($template) {
  if (is_singular('tribe_events')) {
    return get_template_directory() . '/single-tribe_events.php';
  }
  return $template;
});

// AJAX: Load events dynamically based on range
function load_events_callback() {
  date_default_timezone_set('Asia/Tokyo');

  $range = isset($_GET['range']) ? sanitize_text_field($_GET['range']) : 'day';
  $date  = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
  $page  = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
  $per_page = 8;
  $timestamp = strtotime($date);

  switch ($range) {
    case 'week':
      $start_date = date('Y-m-d', strtotime('monday this week', $timestamp));
      $end_date   = date('Y-m-d', strtotime('sunday this week', $timestamp));
      break;
    case 'month':
      $start_date = date('Y-m-01', $timestamp);
      $end_date   = date('Y-m-t', $timestamp);
      break;
    case 'day':
    default:
      $start_date = $date;
      $end_date   = $date;
      break;
  }

  $args = array(
    'post_type'      => 'tribe_events',
    'post_status'    => 'publish',
    'posts_per_page' =>  -1,
    'paged'          => $page,
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

  $post_count = $events->post_count;

  // Start buffer
  ob_start();

  while ($events->have_posts()) : $events->the_post();
    $post_id    = get_the_ID();
    $start_date = get_post_meta($post_id, '_EventStartDate', true);
    $date_obj   = new DateTime($start_date);

    $img_url = get_the_post_thumbnail_url($post_id, 'medium');
    if (!$img_url) {
      $content = get_post_field('post_content', $post_id);
      preg_match('/<img[^>]+src="([^">]+)"/i', $content, $matches);
      $img_url = $matches[1] ?? get_template_directory_uri() . '/assets/img/default.jpg';
    }

    $time    = function_exists('tribe_get_start_time') ? tribe_get_start_time(null, false, 'H:i') : '';
    $endtime = function_exists('tribe_get_end_time') ? tribe_get_end_time(null, false, 'H:i') : '';
    $venue   = function_exists('tribe_get_venue') ? tribe_get_venue() : '';
    $desc    = get_the_excerpt();
    $link    = get_permalink($post_id);

    if (mb_strlen($desc) > 30) {
      $desc = mb_substr($desc, 0, 30) . '...';
    } else {
      $desc = esc_html($desc);
    }
    ?>

    <?php if ($range === 'day') : ?>
      <div class="event-card swiper-slide">
    <?php else : ?>
      <div class="event-card">
    <?php endif; ?>

    <a href="<?php echo esc_url(home_url('/event-detail') . '?event_id=' . get_the_ID()); ?>">
      <?php if ($range === 'month') : ?>
        <div class="date"><p><?= $date_obj->format('m.d'); ?></p></div>
        <div class="title"><?= esc_html(get_the_title()); ?></div>
      <?php endif; ?>

      <?php if ($range === 'day' || $range === 'week') : ?>
        <div class="event-card-img">
          <img src="<?= esc_url($img_url); ?>" alt="Event Image">
          <div class="pink-dot"></div>

          <?php if ($range === 'week') : ?><div class="evnt-month-desplay"><?php endif; ?>

            <div class="date">
              <p><?= $date_obj->format('m.d'); ?></p>
              <span><?= $date_obj->format('Y'); ?><br><?= strtoupper($date_obj->format('D')); ?></span>
            </div>

            <?php if ($range === 'week') : ?>
              <div class="event-card-text">
                <div class="title"><?= esc_html(get_the_title()); ?></div>
                <div class="info">時間: <?= esc_html($time); ?>~ <?= esc_html($endtime); ?><span>|</span> 場所: <?= esc_html($venue); ?></div>
              </div>
            <?php endif; ?>

          <?php if ($range === 'week') : ?></div><?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ($range === 'day') : ?>
        <div class="event-card-text">
          <div class="title"><?= esc_html(get_the_title()); ?></div>
          <div class="info">時間: <?= esc_html($time); ?>~<?= esc_html($endtime); ?> <span>|</span> 場所: <?= esc_html($venue); ?></div>
        <?php endif; ?>

        <?php if ($range === 'day') : ?>
          <div class="contents"><p><?= $desc; ?></p></div>
        </div>
      <?php endif; ?>
    </a>
  </div>

  <?php
  endwhile;

  $rendered = ob_get_clean();

  // Output once
  echo $rendered;

  // Repeat if post count is 2 or 3
  if ($range === 'day' && ($post_count === 2 || $post_count === 3)) {
    echo $rendered;
  }

  wp_reset_postdata();

else :
  echo '<p>指定期間のイベントはありません。</p>';
endif;

  if ($range === 'month') {
    echo '<div class="event-pagination-controls" data-total-pages="' . esc_attr($events->max_num_pages) . '" data-current-page="' . esc_attr($page) . '"></div>';
  }
  wp_die();
}
add_action('wp_ajax_load_events', 'load_events_callback');
add_action('wp_ajax_nopriv_load_events', 'load_events_callback');



// register 
add_filter( 'wpmem_register_heading', function() {
    return '新規会員登録'; // Change this text
});

// Enable email login for WP-Members
add_filter( 'wpmem_login_by_email', '__return_true' );

function custom_login_redirect( $redirect_to, $user_id ) {
    $user = get_user_by( 'id', $user_id );
    if ( $user && isset( $user->ID ) ) {
    
    return home_url( '/?login=success' ); // Add query param

    }
    return $redirect_to;
}
add_filter( 'wpmem_login_redirect', 'custom_login_redirect', 10, 2 );



add_filter( 'authenticate', 'wpmem_allow_email_login', 20, 3 );
function wpmem_allow_email_login( $user, $username, $password ) {
    if ( is_email( $username ) ) {
        $user_obj = get_user_by( 'email', $username );
        if ( $user_obj ) {
            $username = $user_obj->user_login;
        }
    }
    return wp_authenticate_username_password( null, $username, $password );
}

