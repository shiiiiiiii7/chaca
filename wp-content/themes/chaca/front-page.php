<?php get_header(); ?>

<main class="site-main">

    <!-- ヒーローセクション -->
    <section class="hero">

        <!-- 左右に分かれる画像パネル -->
        <div class="hero-panel hero-panel-left"></div>
        <div class="hero-panel hero-panel-right"></div>

        <!-- テキスト -->
        <div class="hero-inner">
            <p class="hero-sub">Bean to Bar Chocolate</p>
            <h1 class="hero-title">Chaca</h1>
        </div>

        <!-- スクロールダウン -->
        <div class="hero-scroll">
            <span class="hero-scroll-text">SCROLL</span>
            <span class="hero-scroll-line"></span>
        </div>

        
    
    </section>

        <!-- fixedヒーローのスクロール領域 -->
    <div class="hero-spacer"></div>
    
    <!-- スクロール後に見えるコンテンツ -->
    <section class="hero-below">
        <div class="hero-below-inner">
            <p>Bean to Bar Chocolateとは、カカオ豆の選定から<br>チョコレートになるまでの全工程を一貫して行うことです。</p>
        </div>
    </section>

    <!-- ✅ ここから追加 -->

<!-- ============================================================
    About Section
    ============================================================ -->

<!-- キャッチコピー -->
<section class="about-catch">
    <div class="about-catch-inner">
        <p class="about-catch-label js-fadeup">Bean to Bar Chocolate</p>
        <h2 class="about-catch-title js-fadeup">一粒のカカオ豆から、<br>チョコレートへ。</h2>
        <p class="about-catch-body js-fadeup">
            Chacaは、カカオ豆の選定から板チョコレートになるまでの<br>
            全工程を、自分たちの手で行っています。
        </p>
    </div>
</section>

<!-- チョコレート工程ストーリー -->
<section class="about-process">

    <div class="about-process-step js-slide-right">
        <div class="about-process-text">
            <p class="about-process-num">01</p>
            <p class="about-process-en">Sourcing</p>
            <h3 class="about-process-title">豆を、選ぶ。</h3>
            <p class="about-process-body">
                カカオ豆は、産地によって風味がまったく異なります。<br>
                フルーティーなもの、ナッツのような香りのもの。<br>
                Chacaでは世界各地の産地を訪れ、<br>
                豆の個性を見極めながら直接仕入れています。
            </p>
        </div>
        <div class="about-process-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hibachi.jpg" alt="カカオ豆の選定">
        </div>
    </div>

    <div class="about-process-step about-process-step--reverse js-slide-left">
        <div class="about-process-text">
            <p class="about-process-num">02</p>
            <p class="about-process-en">Roasting</p>
            <h3 class="about-process-title">焙煎で、<br>香りを引き出す。</h3>
            <p class="about-process-body">
                豆をローストする温度と時間は、<br>
                風味を決める最も重要な工程のひとつ。<br>
                数グラム単位で調整しながら、<br>
                その豆が持つポテンシャルを最大限に引き出します。
            </p>
        </div>
        <div class="about-process-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/store-exterior-entrance.jpeg" alt="焙煎">
        </div>
    </div>

    <div class="about-process-step js-slide-right">
        <div class="about-process-text">
            <p class="about-process-num">03</p>
            <p class="about-process-en">Grinding</p>
            <h3 class="about-process-title">砕いて、<br>なめらかにする。</h3>
            <p class="about-process-body">
                焙煎した豆を粉砕し、長時間かけてすりつぶしていきます。<br>
                この精錬の工程が、なめらかな口溶けをつくります。<br>
                急がず、丁寧に。時間をかけることが<br>
                チョコレートの質を決めます。
            </p>
        </div>
        <div class="about-process-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chaca-product-display-04.jpeg" alt="粉砕・精錬">
        </div>
    </div>

    <div class="about-process-step about-process-step--reverse js-slide-left">
        <div class="about-process-text">
            <p class="about-process-num">04</p>
            <p class="about-process-en">Tempering</p>
            <h3 class="about-process-title">温度を、<br>整える。</h3>
            <p class="about-process-body">
                チョコレートの艶と食感を決めるテンパリング。<br>
                温度を上げ、下げ、また上げる。<br>
                この繰り返しの中で、美しい結晶構造が生まれます。<br>
                パキっと割れる、あの音のために。
            </p>
        </div>
        <div class="about-process-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chaca-shop-inside-atmosphere-04.jpeg" alt="テンパリング">
        </div>
    </div>

    <div class="about-process-step js-slide-right">
        <div class="about-process-text">
            <p class="about-process-num">05</p>
            <p class="about-process-en">Finish</p>
            <h3 class="about-process-title">一枚に、<br>すべてを込めて。</h3>
            <p class="about-process-body">
                型に流し、冷やし固めて完成です。<br>
                カカオ豆から板チョコレートになるまで、<br>
                すべての工程を自分たちの手で。<br>
                その一枚に、産地の風景が宿っています。
            </p>
        </div>
        <div class="about-process-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stores2.jpg" alt="完成">
        </div>
    </div>

</section>

<!-- フィロソフィー（行ごとにフェードイン） -->
<section class="about-philosophy">
    <div class="about-philosophy-inner">
        <p class="about-philosophy-line js-line">チョコレートをつくるということは、</p>
        <p class="about-philosophy-line js-line">カカオが育った土地に、</p>
        <p class="about-philosophy-line js-line">寄り添うことだと思っています。</p>
        <p class="about-philosophy-line js-line">&nbsp;</p>
        <p class="about-philosophy-line js-line">豆の声を聞きながら、</p>
        <p class="about-philosophy-line js-line">急がず、手を抜かず、</p>
        <p class="about-philosophy-line js-line">ただ丁寧に。</p>
        <p class="about-philosophy-line js-line">&nbsp;</p>
        <p class="about-philosophy-line js-line">一口食べたとき、</p>
        <p class="about-philosophy-line js-line">カカオが育った景色を感じてほしい。</p>
        <p class="about-philosophy-line js-line">それが、Chacaのチョコレートです。</p>
    </div>
</section>

<!-- Shop へ誘導 -->
<section class="about-cta">
    <div class="about-cta-inner js-fadeup">
        <h2 class="about-cta-title">Chacaのチョコレートを、<br>手に取ってみてください。</h2>
        <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>" class="about-cta-button">
            商品を見る
        </a>
    </div>
</section>    
<!-- ✅ ここまで追加 -->
</main>

<?php get_footer(); ?>
