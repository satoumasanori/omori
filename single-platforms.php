<?php
get_header();
?>
<?php set_post_views(get_the_ID()); ?>

<section class="event-firstview firstview">
  <div class="f-left event-f-left">
    <div class="f-to-event">
      <div class="section-title">
        <span class="blue">P</span>
        <span class="pink">l</span>
        <span class="yellow">a</span>
        <span class="black">t</span>
        <span class="blue">f</span>
        <span class="pink">o</span>
        <span class="yellow">r</span>
        <span class="black">m</span>
        <span class="blue">s</span>
      </div>
      <div class="event-title">大森ナレッジバンク</div>
      <div class="f-event-content">
        <h3>大森のことを<br>もっとたくさん知ろう！</h3>
      </div>
    </div>
  </div>
  <div class="event-f-right">
    <div class="event-f-right-img">
      <?php
      $image = get_field('plat_photo');
      if ($image) {
        $url = $image['url'];
        $alt = $image['alt'];
        echo '<img src="' . $url . '" alt="' . $alt . '" />';
      }
      ?>
    </div>
    <div class="f-right-link">
      <p>TOP</p><span>></span>
      <p>大森ナレッジバンク</p>
    </div>
  </div>
</section>
<section class="event-content">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 85.png" class="pink-shape" alt="">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 84.png" class="blue-shape" alt="">
  <div class="event-content-text-part">
    <h2 class="plat-h2"><?php echo get_post_meta(get_the_ID(), "plat_title", true); ?></h2>
    <p class="plat-date"><?php echo get_post_meta(get_the_ID(), "plat_date", true); ?></p>
    <?php
    $tags = get_the_tags();
    if ($tags) {
      echo '<div class="tags">';
      foreach ($tags as $tag) {
        echo '<div class="tag">' . esc_html($tag->name) . '</div>';
      }
      echo '</div>';
    }
    ?>
    <h3 class="plat-h3"><?php echo get_post_meta(get_the_ID(), "plat_description", true); ?></h3>
  </div>
  <h2 class="event-content-amount plat-h2">この質問の回答 （
    <span><?php echo get_post_meta(get_the_ID(), "plat_answer_number", true); ?>件</span> ）
  </h2>
  <div class="event-content-cards">
    <div class="event-content-card">
      <div class="event-content-card-img">
        <img src="" alt="">
      </div>
      <div class="event-content-card-text">
        <h3>回答者名（<span>ニックネームなど</span>）</h3>
        <span class="event-content-card-text-age">年齢（回答できる範囲で掲載）</span>
        <p class="event-content-card-text-p">
          テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキストテキストテキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキスト
        </p>
        <p>テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキスト</p>
      </div>
    </div>
    <div class="event-content-card">
      <div class="event-content-card-img">
        <img src="" alt="">
      </div>
      <div class="event-content-card-text">
        <h3>回答者名（<span>ニックネームなど</span>）</h3>
        <span class="event-content-card-text-age">年齢（回答できる範囲で掲載）</span>
        <p class="event-content-card-text-p">
          テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキストテキストテキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキスト
        </p>
        <p>テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキスト</p>
      </div>
    </div>
    <div class="event-content-card">
      <div class="event-content-card-img">
        <img src="" alt="">
      </div>
      <div class="event-content-card-text">
        <h3>回答者名（<span>ニックネームなど</span>）</h3>
        <span class="event-content-card-text-age">年齢（回答できる範囲で掲載）</span>
        <p class="event-content-card-text-p">
          テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキストテキストテキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキスト
        </p>
        <p>テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキスト</p>
      </div>
    </div>
    <div class="event-content-card">
      <div class="event-content-card-img">
        <img src="" alt="">
      </div>
      <div class="event-content-card-text">
        <h3>回答者名（<span>ニックネームなど</span>）</h3>
        <span class="event-content-card-text-age">年齢（回答できる範囲で掲載）</span>
        <p class="event-content-card-text-p">
          テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキストテキストテキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキスト
        </p>
        <p>テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキスト</p>
      </div>
    </div>
    <div class="event-content-card">
      <div class="event-content-card-img">
        <img src="" alt="">
      </div>
      <div class="event-content-card-text">
        <h3>回答者名（<span>ニックネームなど</span>）</h3>
        <span class="event-content-card-text-age">年齢（回答できる範囲で掲載）</span>
        <p class="event-content-card-text-p">
          テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキストテキストテキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキストテキス
          トテキストテキストテキストテキスト
        </p>
        <p>テキストテキストテキストテ
          キストテキストテキストテキストテキストテキストテキストテキスト</p>
      </div>
    </div>
  </div>
  <div class="event-content-btn">
    <a href="<?php echo home_url(); ?>"><button>TOPへ戻る</button></a>
  </div>
</section>

<?php
get_footer();
?>