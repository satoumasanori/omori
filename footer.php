 <footer>
    <div class="footer-left">
      <div class="footer-card">
        <div class="footer-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/footer-logo.png" alt=""></div>
        <div class="footer-address">
          〒143-0015<br>
          東京都大田区大森西1-2-3<br>
          大森コミュニティビル2F
        </div>
        <div class="footer-icons">
          <span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="footer-right">
      <div class="footer-contact">
        <div class="footer-contact-title">・お問い合わせ</div>
        <div class="footer-sns">
          <span>SNS</span><span>SNS</span><span>SNS</span><span>SNS</span>
        </div>
      </div>
      <div class="footer-menus">
        <div class="footer-menu">
          <div class="footer-menu-title">・Menu</div>
          <ul>
            <a href="<?php echo home_url(); ?>#event"><li>イベントカレンダー</li></a>
            <a href="<?php echo home_url(); ?>#quiz"><li>今日の質問</li></a>
            <a href="<?php echo home_url(); ?>#platforms"><li>ナレッジバンク</li></a>
            <a href="<?php echo home_url(); ?>#picture"><li>大森図鑑</li></a>
            <a href="<?php echo home_url(); ?>#history"><li>大森の歴史</li></a>
            <a href="<?php echo home_url(); ?>#ofc"><li>OFCとは</li></a>
          </ul>
        </div>
        <div class="footer-menu footer-menu-right"> 
          <div class="footer-menu-title">・Contact</div>
          <ul>
            <li>お問い合わせフォーム</li>
            <li>メンバー募集</li>
            <li>イベント協賛</li>
            <li>取材依頼</li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright">
        © 2025 OOMORI FAN CLUB All Rights Reserved.
      </div>
    </div>
  </footer>
   <?php wp_footer();?>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</html>