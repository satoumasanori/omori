<?php
get_header();
?>
<section class="firstview">
    <?php if ( isset($_GET['login']) && $_GET['login'] === 'success' ) : ?>
  <div id="login-notification" class="login-notification success" style="background:#e6f7e6;color:#207520;padding:16px 24px;max-width:600px;border-radius:8px;font-size:18px;box-shadow:0 2px 8px rgba(0,0,0,0.07);text-align:center;position:fixed;left:-700px;top:40px;z-index:9999;transition:left 0.8s cubic-bezier(.77,0,.18,1), opacity 0.5s;opacity:1;">
    <strong>✅ ログインに成功しました！</strong> ようこそ。
  </div>
<?php endif; ?>
  <div class="f-left">
    <div class="f-to-event">
      <div class="renaming-day">
        <p>大森駅開業<span>150</span>周年まで あと<span  id="countdown-days"></span>日 ！</p>
      </div>

      <?php
      $today = date('Y-m-d');
      $args = [
        'post_type'      => 'tribe_events',
        'posts_per_page' => 1,
        'meta_query'     => [
          [
            'key'     => '_EventStartDate',
            'value'   => [$today . ' 00:00:00', $today . ' 23:59:59'],
            'compare' => 'BETWEEN',
            'type'    => 'DATETIME',
          ],
        ],
        'orderby'  => 'meta_value',
        'meta_key' => '_EventStartDate',
        'order'    => 'ASC',
      ];

      $today_event_query = new WP_Query($args);
      ?>

      <div class="f-event-date">
        <h3><?php echo date('m'); ?><span>.</span><?php echo date('d'); ?></h3>
        <p><?php echo date('Y'); ?><br><?php echo strtoupper(date('D')); ?></p>
        <h2>本日のイベント</h2>
      </div>

      <?php if ($today_event_query->have_posts()) : ?>
        <?php while ($today_event_query->have_posts()) : $today_event_query->the_post(); ?>
          <?php
          $title = get_the_title();
          $start_time = function_exists('tribe_get_start_time') ? tribe_get_start_time(get_the_ID(), false, 'H:i') : '';
          $end_time = function_exists('tribe_get_end_time') ? tribe_get_end_time(get_the_ID(), false, 'H:i') : '';
          $venue = function_exists('tribe_get_venue') ? tribe_get_venue(get_the_ID()) : '';
          $excerpt = get_the_excerpt();
          ?>
          <div class="f-event-title"><?php echo esc_html($title); ?></div>
          <div class="f-event-content">
            <div class="info">
              <p>INFORMATION</p>
              <div></div>
            </div>
            <p>時間: <?php echo esc_html($start_time); ?>~ <?php echo esc_html($end_time); ?>| 場所: <?php echo esc_html($venue); ?></p>
            <h3><?php echo esc_html($excerpt); ?></h3>
          </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="f-event-title">本日のイベントはありません</div>
      <?php endif; ?>

      <div class="f-to-question">
        <p class="f-to-question-title">今日の質問</p>
        <div class="f-to-question-content">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/スクリーンショット 2025-05-02 13.31.49.png" class="emogics" alt="">
          <div class="f-to-question-content-text">
            <p>大森海岸の貝塚を発見した人物は誰でしょう？</p>
          </div>
        </div>
        <div class="answer">
          <p>回答する</p>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow.png" class="arrow" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="f-right">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/event.jpg" alt="No image">
  </div>
</section>

<section class="news">
  <div class="section-text-part">
    <div class="section-title">
      <span class="blue">N</span>
      <span class="pink">e</span>
      <span class="yellow">w</span>
      <span class="black">s</span>
    </div>
    <p>最新のお知らせ</p>
  </div>

  <div class="news-right">
    <div class="news-info">
      <?php
      $popular_posts_args = array(
        'posts_per_page' => 2,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_type' => "news"
      );
      $voice_query = new WP_Query($popular_posts_args);

      if ($voice_query->have_posts()):
        while ($voice_query->have_posts()):
          $voice_query->the_post();
          ?>
          <a class="sub-news-link" href="<?php echo get_permalink() ?>"><div class="news-item" >
            <span class="news-date"><?php echo get_field('news_date'); ?></span>
            <span class="news-title"><?php echo get_the_title(); ?></span>
          </div></a>
          <?php
        endwhile;
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
    <div class="more-button">
      <span>もっと見る</span>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow.png" alt="" class="news-arrow">
    </div>
  </div>
</section>

<?php $events = get_today_events_query(); ?>
<section class="event" id="event">
    <div class="event-cube-decoration-pink"></div>
    <div class="event-cube-decoration-blue"></div>
     <div class="range-button-group">
      <button class="range-day range-button active" data-range="day">日表示</button>
      <button class="range-week range-button" data-range="week">週間</button>
      <button class="range-month range-button" data-range="month">月間</button>
    </div> 
    <div class="event-container">

    <div class="quiz-sidebar">
      <div class="section-title">
        <span class="blue">E</span><span class="pink">v</span><span class="yellow">e</span>
        <span class="black">n</span><span class="blue">t</span>
      </div>
    </div>

    <div class="event-right">
      <div class="quiz-sidebar">
        <div class="section-title">
          <span class="blue">E</span><span class="pink">v</span><span class="yellow">e</span>
          <span class="black">n</span><span class="blue">t</span>
        </div>
      </div>
      <div class="event-handle-button">
        <p>イベントカレンダー</p>
        <div class="event-button-group">
          <div class="event-calendar-btn next-btn">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/prev.png" alt="" class="news-arrow">
          </div>
          <div class="event-calendar-btn prev-btn">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/next.png" alt="" class="news-arrow">
          </div>
          <div id="event-range-label"><p></p></div>
        </div>
      </div>
      <div class="event-slide calendarSwiper" id="event-box">
        <div class="day-event-cards " id="event-results">
        </div>
      </div>
      <div class="event-month-pagination" id="event-pagination-handle-button" >
        <button class="month-btn month-prev-btn">前ー</button>
        <button class="month-btn month-next-btn">次ー</button>
      </div>
    </div>
  </div>

</section>

<section class="quiz" id="quiz">
  <div class="quiz-sidebar">
    <div class="section-title">
      <span class="blue">Q</span>
      <span class="pink">u</span>
      <span class="yellow">e</span>
      <span class="black">s</span>
      <span class="blue">t</span>
      <span class="pink">i</span>
      <span class="yellow">o</span>
      <span class="black">n</span>
    </div>
    <span class="section-title-jp">クイズ</span>
  </div>
  <div class="quiz-content">
    <h2 class="quiz-title">◯◯くんに挑戦！クイズに正解してポイントゲット！</h2>
    <div class="quiz-question-box">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/スクリーンショット 2025-05-02 13.31.49.png"
        class="quiz-icon" alt="avatar">
      <?php
      $popular_posts_args = array(
        'posts_per_page' => 1,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_type' => "question"
      );
      $voice_query = new WP_Query($popular_posts_args);

      if ($voice_query->have_posts()):
        while ($voice_query->have_posts()):
          $voice_query->the_post();
          ?>
          <div class="speech-bubble">
            <p><?php echo get_the_title(); ?></p>
          </div>
        </div>
        <div class="quiz-answers" id="question_select">
          <div id="correct_answer" style="display:none;"><?php echo get_field('quiz_correct_answer'); ?></div>

          <button class="quiz-option selected"><?php echo get_field('quiz_select1'); ?></button>
          <button class="quiz-option"><?php echo get_field('quiz_select2'); ?></button>
          <button class="quiz-option"><?php echo get_field('quiz_select3'); ?></button>
          <button class="quiz-option"><?php echo get_field('quiz_select4'); ?></button>
        </div>
        <a href="<?php echo site_url(); ?>/question">
          <button class="quiz-result">
            <div id="answer" answer="<?php echo get_field('quiz_select1'); ?>">
              『<?php echo get_field('quiz_select1'); ?>』で回答する！</div>
          </button>
        </a>
        <p class="quiz-note-bottom">選択した回答を自動出力させる</p>
      </div>
      <?php
        endwhile;
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

  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 83.png" class="quiz-shape" alt="">
</section>

<section class="platforms" id="platforms">
  <div class="plat-header">
    <div class="section-text-part">
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
      <p>大森ナレッジバンク</p>
    </div>
    <div class="subtitle">
      大森のことを<br>もっとたくさん知ろう！
    </div>
  </div>

  <div class="plat-content">
    <div class="plat-cards">
      <?php
      $popular_posts_args = array(
        'posts_per_page' => 6,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_type' => "platforms"
      );
      $voice_query = new WP_Query($popular_posts_args);

      if ($voice_query->have_posts()):
        while ($voice_query->have_posts()):
          $voice_query->the_post();
          ?>
          <div class="plat-card"><a href="<?php echo get_permalink() ?>">
              <div class="plat-card-img">
                <?php
                $image = get_field('plat_photo');
                if ($image) {
                  $url = $image['url'];
                  $alt = $image['alt'];
                  echo '<img src="' . $url . '" alt="' . $alt . '" />';
                }
                ?>
              </div>
              <div class="date"><?php echo get_field('plat_date'); ?></div>
              <div class="title"><?php echo get_field('plat_title'); ?></div>
              <div class="description">
                <?php echo get_field('plat_description'); ?>
              </div>
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
              <div class="plat-answer">回答 <?php echo get_field('plat_answer_number'); ?>件</div>
            </a>
          </div>
          <?php
        endwhile;
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
  <div class="plat-shape"></div>
  <div class="plat-shape-round"></div>
</section>

<section class="picture" id="picture">
  <div class="picture-heading">
    <div class="picture-heading-left">
      <div class="section-title">
        <span class="blue">P</span>
        <span class="pink">i</span>
        <span class="yellow">c</span>
        <span class="black">t</span>
        <span class="blue">u</span>
        <span class="pink">r</span>
        <span class="yellow">e</span>
        <p>　</p>
        <span class="blue">B</span>
        <span class="pink">o</span>
        <span class="yellow">o</span>
        <span class="black">k</span>
      </div>
      <div class="picture-heading-area">
        <p>大森図鑑</p>
      </div>
      <div class="picture-heading-right ">
        <p class="picture-subtitle">地域で活躍する<br>素敵な人々を紹介します</p>
      </div>
    </div>
    <div class="picture-heading-right ">
      <p class="picture-subtitle">地域で活躍する<br>素敵な人々を紹介します</p>
    </div>
  </div>

  <div class="picture-slide mySwiper" id="pictureSlide">
    <div class="swiper-handle-group">
      <div class="swiper-button-prev"
        style="background-color: #fff; position: relative; color:#000; display:flex; justify-content: center; padding: 0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/prev.png" alt="" class="news-arrow">
      </div>
      <div class="swiper-button-next"
        style="background-color: #fff; position: relative; color:#000; display:flex; justify-content: center; padding: 0;">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/next.png" alt="" class="news-arrow">
      </div>
    </div>
    <div class="picture-wrap swiper-wrapper" id="pictureWrap">
      <?php
      $popular_posts_args = array(
        'posts_per_page' => 6,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_type' => "picture_book"
      );
      $voice_query = new WP_Query($popular_posts_args);

      if ($voice_query->have_posts()):
        while ($voice_query->have_posts()):
          $voice_query->the_post();
          ?>
          <div class="item swiper-slide">
            <div class="item-img">
              <?php
              $image = get_field('pic-card-img');
              if ($image) {
                $url = $image['url'];
                $alt = $image['alt'];
                echo '<img src="' . $url . '" alt="' . $alt . '" />';
              }
              ?>
              <a href="<?php echo get_permalink() ?>">
                <div class="item-img-btn">
                  <p>もっと見る</p>
                  <p>⟶</p>
                </div>
              </a>
            </div>
            <div class="item-author">
              <p><?php echo get_field('pic-title'); ?></p>
              <p><?php echo get_field('pic-category'); ?></p>
            </div>
            <p class="item-description">
              <?php echo get_field('pic-card-desc'); ?>
            </p>
          </div>
          <?php
        endwhile;
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

<section class="history" id="history">
  <div class="history-container">
    <div class="history-content">
      <div class="section-title">
        <span class="blue">H</span>
        <span class="pink">i</span>
        <span class="yellow">s</span>
        <span class="black">t</span>
        <span class="blue">o</span>
        <span class="yellow">r</span>
        <span class="pink">y</span>
      </div>
      <p class="jp">大森の歴史</p>
      <div class="history-desc">時を超えて続く大森の物語</div>
      <div class="history-slide historySwiper">
        <div class=" history-slide-wrap  swiper-wrapper">
          <div class="history-item swiper-slide" style="display: flex;">
            <div class="history-item-container">
              <div class="item-age">
                <p>history</p>
                <p>1990</p>
              </div>
              <div class="history-item-content">
                <p>1タイトル</p>
                <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              </div>

            </div>
          </div>
          <div class="history-item swiper-slide" style="display: flex;">
            <div class="history-item-container">
              <div class="item-age">
                <p>history</p>
                <p>1990</p>
              </div>
              <div class="history-item-content">
                <p>2タイトル</p>
                <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              </div>

            </div>
          </div>
          <div class="history-item swiper-slide" style="display: flex;">
            <div class="history-item-container">
              <div class="item-age">
                <p>history</p>
                <p>1990</p>
              </div>
              <div class="history-item-content">
                <p>3タイトル</p>
                <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              </div>

            </div>
          </div>
          <div class="history-item swiper-slide" style="display: flex;">
            <div class="history-item-container">
              <div class="item-age">
                <p>history</p>
                <p>1990</p>
              </div>
              <div class="history-item-content">
                <p>4タイトル</p>
                <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              </div>

            </div>
          </div>
          <div class="history-item swiper-slide" style="display: flex;">
            <div class="history-item-container">
              <div class="item-age">
                <p>history</p>
                <p>1990</p>
              </div>
              <div class="history-item-content">
                <p>5タイトル</p>
                <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
              </div>

            </div>
          </div>
        </div>
        <div class="history-handle-btn">
          <div class="swiper-button-prev">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/prev.png" alt="" class="news-arrow">
          </div>
          <div class="swiper-button-next">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/next.png" alt="" class="news-arrow">
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</section>

<section class="ofc" id="ofc">
  <div class="ofc-up">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Vector.png" class="ofc-shape" alt="">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFC-watermark.png" class="ofc-shape-watermark"
      alt="">
    <div class="section-text">
      <div class="section-text-left">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Vector1.png" alt="">
        <div class="section-title">
          <span class="blue">O</span>
          <span class="pink">F</span>
          <span class="yellow">C</span>
        </div>
      </div>
      <div class="section-text-right">
        <p>OMORI FUN CLUBの</p>
        <h2>活動と理念</h2>
      </div>
    </div>
    <div class="swiper ofcSwiper">
      <div class="ofc-policy">
        <p class="ofc-subtitle">policy</p>
        <p class="ofc-title">私たちの思い</p>
        <div class="ofc-description">
          <p>OOMORI FUN
            CLUB（OFC）は、大森という街の魅力を再発見し、発信していくことを目的として2016年に設立された地域コミュニティ団体です。大森駅周辺の商店、企業、住民が一体となり、地域の活性化と交流促進を目指しています。
          </p>
          <p>
            「大森をもっと楽しく、もっと繋がりのある街に」をモットーに、様々なイベントの企画・運営や、地域の情報発信、歴史や文化の継承活動などを行っています。メンバーは年齢や職業も様々で、大森を愛する気持ちを共有する仲間たちです。
          </p>
        </div>
      </div>
      <div class="swiper-wrapper">
        <?php
        $popular_posts_args = array(
          'posts_per_page' => 6,
          'orderby' => 'meta_value_num',
          'order' => 'DESC',
          'post_type' => "ofc"
        );
        $voice_query = new WP_Query($popular_posts_args);
        if ($voice_query->have_posts()):
          while ($voice_query->have_posts()):
            $voice_query->the_post();
            ?>
            <div class="ofc-photo swiper-slide">
              <?php
              $image = get_field('ofc-photo');
              if ($image) {
                $url = $image['url'];
                $alt = $image['alt'];
                echo '<img src="' . $url . '" alt="' . $alt . '" />';
              }
              ?>
            </div>
            <?php
          endwhile;
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
  </div>
  <div class="ofc-down">
    <div class="ofc-down-img">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Ellipse 30.png" alt="">
    </div>
    <div class="ofc-down-text">
      <p>Beer</p>
      <h2>大森山王ビール</h2>
      <p>大森山王ビールは、OFCが2018年に地元の醸造所と共同開発したクラフトビールです。
        大森の歴史ある山王地区の名前を冠し、地域の誇りを表現した一品です。
        原料の一部には地元の農家が育てたホップを使用し、地産地消の理念も大切にしています。</p>
      <p>現在、「山王ペールエール」「大森ヴァイツェン」「海岸IPA」の3種類を展開。
        地元の飲食店で味わえるほか、特別イベントでも提供しています。
        大森の新しい名物として、多くの方に親しまれています。</p>
    </div>
  </div>
</section>

<section class="activity">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape-yellow.png" class="ofc-shape" alt="">
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/activity-watermark.png"
    class="activity-shape-watermark" alt="">
  <div class="section-text-part">
    <div class="section-title-img">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/btn-yellow.png" alt="">
      <div class="section-title">
        <span class="blue">A</span>
        <span class="pink">c</span>
        <span class="yellow">t</span>
        <span class="black">i</span>
        <span class="blue">v</span>
        <span class="pink">i</span>
        <span class="yellow">t</span>
        <span class="black">i</span>
        <span class="blue">e</span>
        <span class="pink">s</span>
      </div>
    </div>
    <div class="section-title-text">活動内容</div>
  </div>
  <div class="activity-content">
    <div class="activity-items">
      <div class="activity-item">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" class="activity-item-img"></img>
        <div class="activity-item-title">
          <div class="label">Activities</div>
          <h2>地域イベント</h2>
          <p>四季折々のイベントを企画・運営。大森マルシェ、
            夏祭り、ハロウィンパレードなど年間を通じて賑わいを創出。</p>
        </div>
      </div>
      <div class="activity-item1">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg"
          class="sp-activity-item-img1"></img>
        <div class="activity-item-title">
          <div class="label">Activities</div>
          <h2>地域イベント</h2>
          <p>四季折々のイベントを企画・運営。大森マルシェ、
            夏祭り、ハロウィンパレードなど年間を通じて賑わいを創出。</p>
        </div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" class="activity-item-img1"></img>
      </div>
    </div>
    <div class="activity-items">
      <div class="activity-item">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" class="activity-item-img"></img>
        <div class="activity-item-title">
          <div class="label">Activities</div>
          <h2>地域イベント</h2>
          <p>四季折々のイベントを企画・運営。大森マルシェ、
            夏祭り、ハロウィンパレードなど年間を通じて賑わいを創出。</p>
        </div>
      </div>
      <div class="activity-item1">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg"
          class="sp-activity-item-img1"></img>
        <div class="activity-item-title">
          <div class="label">Activities</div>
          <h2>地域イベント</h2>
          <p>四季折々のイベントを企画・運営。大森マルシェ、
            夏祭り、ハロウィンパレードなど年間を通じて賑わいを創出。</p>
        </div>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" class="activity-item-img1"></img>
      </div>
    </div>
</section>
<?php
get_footer();
?>