<?php
get_header();
?>

<?php
// Check if we came from the quiz page with an answer
if (isset($_GET['answer']) && isset($_GET['correct'])) {
    $isCorrect = $_GET['correct'] === 'true';
    ?>
    <div id="notification" class="notification <?php echo $isCorrect ? 'success' : 'error'; ?>" style="display: none;">
        <?php if ($isCorrect): ?>
            正解です！ポイントを獲得しました！
        <?php else: ?>
            残念！不正解です。
        <?php endif; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if this is the first time showing the notification
            const hasShownNotification = sessionStorage.getItem('hasShownNotification');
            
            if (!hasShownNotification) {
                const notification = document.getElementById('notification');
                notification.style.display = 'block';
                
                // Set flag in session storage
                sessionStorage.setItem('hasShownNotification', 'true');
                
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }
        });
    </script>
    <?php
}
?>

<style>
.notification {
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    padding: 15px 25px;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    z-index: 1000;
    animation: slideIn 0.5s ease-out;
}

.notification.success {
    background-color: #4CAF50;
}

.notification.error {
    background-color: #f44336;
}

@keyframes slideIn {
    from {
        transform: translate(-100%, -50%);
        opacity: 0;
    }
    to {
        transform: translate(0, -50%);
        opacity: 1;
    }
}
</style>

<section class="event-firstview firstview">
    <div class="f-left event-f-left">
        <div class="f-to-event">
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
            <div class="event-title">クイズ</div>
            <div class="f-event-content">
                <h3>クイズに正解してポイントゲット！</h3>
            </div>
        </div>
    </div>
    <div class="event-f-right">
        <div class="question-f-right-img">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/OFCとは.jpg" alt="">
        </div>
        <div class="f-right-link">
            <p>TOP</p><span>></span>
            <p>クイズ</p>
        </div>
    </div>
</section>

<section class="event-content">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 85.png" class="pink-shape" alt="">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Rectangle 84.png" class="blue-shape" alt="">

    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
        'post_type'      => 'question',
        'posts_per_page' => 5,
        'paged'          => $paged,
        'post_status'    => 'publish',
        'orderby'       => 'date',
        'order'         => 'DESC'
    );

    $loop = new WP_Query($args);
    
    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="qa-ele">
                <div class="qa-ele-question">
                    <div class="qa-ele-text">
                        <span><?php echo get_the_date(get_option('date_format')); ?></span>
                        <p><?php echo get_field('today_question'); ?></p>
                    </div>
                    <div class="answer-button">
                        <span class="text">回答を見る</span>
                        <span class="icon">
                            <svg width="40" height="40" viewBox="0 0 40 40">
                                <circle cx="20" cy="20" r="20" stroke="black" stroke-dasharray="4" stroke-width="2" fill="none" />
                            </svg>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Arrow-right.png" alt="">
                        </span>
                    </div>
                </div>
                <div class="qa-ele-answer">
                    <p><?php echo get_field('quiz_answer'); ?></p>
                </div>
            </div>
        <?php
        endwhile;

        // WP-PageNavi Pagination
        if (function_exists('wp_pagenavi')) {
            echo '<div class="pagination-wrapper">';
            wp_pagenavi(array('query' => $loop)); // Pass your custom query
            echo '</div>';
        }
    } else {
        echo '<p>クイズが見つかりませんでした。</p>';
    }
    
    wp_reset_postdata();
    ?>

    <div class="event-content-btn">
        <a href="<?php echo home_url(); ?>"><button>TOPへ戻る</button></a>
    </div>
</section>
<style>
    /* Style for WP-PageNavi */
.wp-pagenavi {
    clear: both;
    text-align: center;
    margin: 20px 0;
}
.wp-pagenavi a, 
.wp-pagenavi span {
    padding: 5px 10px;
    margin: 0 2px;
    border: 1px solid #ddd;
    text-decoration: none;
}
.wp-pagenavi a:hover {
    background: #f5f5f5;
}
.wp-pagenavi span.current {
    background: #0073aa;
    color: #fff;
    border-color: #0073aa;
    font-weight: bold;
}
</style>
<?php get_footer(); ?>