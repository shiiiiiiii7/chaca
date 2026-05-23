<?php
defined( 'ABSPATH' ) || exit;

$checkout = WC()->checkout();//オブジェクトの取得処理を追加

// ログイン中でなくログインが必要な場合
if ( ! is_user_logged_in() && wc_get_page_id( 'myaccount' ) && 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
    woocommerce_login_form( array( 'redirect' => wc_get_checkout_url() ) );
}
?>

<div class="checkout-wrapper">

    <div class="cart-hero">
        <h1 class="cart-title">Checkout</h1>
        <p class="cart-sub">購入手続き</p>
    </div>

    <?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

    <form name="checkout" method="post" class="checkout-form woocommerce-checkout"
        action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
        enctype="multipart/form-data">

        <div class="checkout-container">

            <!-- 左：お客様情報 -->
            <div class="checkout-fields">

                <?php if ( $checkout->get_checkout_fields() ) : ?>
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="checkout-section">
                        <h2 class="checkout-section-title">お客様情報</h2>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <?php if ( WC()->cart->needs_shipping() ) : ?>
                    <div class="checkout-section">
                        <h2 class="checkout-section-title">お届け先</h2>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                    <?php endif; ?>

                    <div class="checkout-section">
                        <h2 class="checkout-section-title">備考</h2>
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                    </div>

                <?php endif; ?>

            </div>

            <!-- 右：注文内容 -->
            <div class="checkout-sidebar">

                <div class="checkout-section">
                    <h2 class="checkout-section-title">ご注文内容</h2>
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

            </div>

        </div>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

    </form>

</div>