<?php

/**
 * Chaca テーマの設定ファイル
 */

// ============================================================
// 1. テーマの基本設定
// ============================================================
function chaca_setup() {

    // タイトルタグをWordPressに管理させる
    add_theme_support( 'title-tag' );

    // アイキャッチ画像を使えるようにする
    add_theme_support( 'post-thumbnails' );

    // WooCommerceを使えるようにする
    add_theme_support( 'woocommerce' );

    // ナビゲーションメニューを登録する
    register_nav_menus( [
        'primary' => 'メインメニュー',
    ] );
}
add_action( 'after_setup_theme', 'chaca_setup' );


// ============================================================
// 2. CSSとJavaScriptの読み込み
// ============================================================
function chaca_scripts() {

    // メインCSSを読み込む
    wp_enqueue_style(
        'chaca-style',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '1.0.0'
    );
    // メインJSを読み込む
    wp_enqueue_script(
        'chaca-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );
    
    // JavaScriptにajaxurlをローカライズ
    wp_localize_script(
        'chaca-main',
        'ajaxurl',
        admin_url('admin-ajax.php')
    );

    wp_enqueue_script('wc-cart-fragments');
}
add_action( 'wp_enqueue_scripts', 'chaca_scripts' );

// トップページのbodyにtransparent-headerクラスを追加
add_filter( 'body_class', function( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'transparent-header';
    }
    return $classes;
} );


// ==================================================
// AJAX：最新在庫数取得
// ==================================================

add_action('wp_ajax_get_product_stock', 'get_product_stock');
add_action('wp_ajax_nopriv_get_product_stock', 'get_product_stock');

function get_product_stock() {

    $product_id = intval($_POST['product_id']);

    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error();
    }

    $stock = $product->get_stock_quantity();

    wp_send_json_success(array(
        'stock' => $stock
    ));
}

// ==================================================
// WooCommerce カート数 AJAX更新
// ==================================================

add_filter( 'woocommerce_add_to_cart_fragments', 'chaca_cart_count_fragment' );

function chaca_cart_count_fragment( array $fragments ): array {
    $count = WC()->cart->get_cart_contents_count();
    ob_start();
    ?>
    <span class="cart-count"<?php echo $count === 0 ? ' style="display:none"' : ''; ?>>
        <?php echo esc_html( $count ); ?>
    </span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}
// 空カートページのデフォルト絵文字アイコンを非表示
add_action( 'init', function() {
    remove_action( 'woocommerce_cart_is_empty', 'woocommerce_empty_cart_message', 10 );
} );