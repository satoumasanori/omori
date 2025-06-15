<?php
get_header();
?>
<section class="news detail-news">
  <div class="section-text-part" style="border-top: none;">
    <div class="section-title">
      <span class="blue">N</span>
      <span class="pink">e</span>
      <span class="yellow">w</span>
      <span class="black">s</span>
    </div>
    <p>最新のお知らせ</p>
  </div>

  <div class="news-right" style="border-top: none; align-items: center;">
    <div class="sub-news-info">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $popular_posts_args = array(
        'post_type' => 'news',
        'posts_per_page' => 10,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
      );
      $voice_query = new WP_Query($popular_posts_args);

      if ($voice_query->have_posts()):
        while ($voice_query->have_posts()):
          $voice_query->the_post();
          ?>
          <a class="sub-news-link" href="<?php echo get_permalink() ?>">
            <div class="sub-news-item">
              <span class="news-date"><?php echo get_field('news_date'); ?></span>
              <span class="news-title"><?php echo get_the_title(); ?></span>
            </div>
          </a>
          <?php
        endwhile;
        if (function_exists('wp_pagenavi')) {
          echo '<div class="pagination-wrapper">';
          wp_pagenavi(array('query' => $voice_query)); // Pass your custom query
          echo '</div>';
        }
        wp_reset_postdata();
      else:
        ?>
        <div class="vcard">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/default-profile.jpg" alt="Profile">
          <div class="testimonial">
            現在データはありません。
          </div>
          <div class="meta">
            <span>Coming Soon</span>
          </div>
          <div class="tag">準備中</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<div class="event-content-btn">
  <a href="<?php echo home_url(); ?>"><button>TOPへ戻る</button></a>
</div>

<?php
get_footer();
?>