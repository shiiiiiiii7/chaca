<?php
defined( 'ABSPATH' ) || exit;

if ( WC()->cart->is_empty() ) {
    wc_get_template( 'cart/cart-empty.php' );
    do_action( 'woocommerce_after_cart' );
    return;
}
?>

<div class="cart-wrapper">


    <?php do_action( 'woocommerce_before_cart' ); ?>

    <form class="woocommerce-cart-form cart-form"
          action="<?php echo esc_url( wc_get_cart_url() ); ?>"
          method="post">

        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="cart-items-wrapper">

            <div class="cart-items-header">
                <span>商品</span>
                <span>数量</span>
                <span>価格</span>
            </div>

            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                $_product        = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id      = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                    $product_class = apply_filters( 'woocommerce_cart_item_class', 'cart-item', $cart_item, $cart_item_key );
            ?>

            <div class="<?php echo esc_attr( $product_class ); ?>">

                <div class="cart-item-image">
                    <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    echo $product_permalink ? sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ) : $thumbnail;
                    ?>
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="cart-item-remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s">削除</a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            esc_attr__( 'Remove this item', 'woocommerce' ),
                            esc_attr( $product_id ),
                            esc_attr( $cart_item_key )
                        ),
                        $cart_item_key
                    );
                    ?>
                </div>

                <div class="cart-item-info">
                    <p class="cart-item-name">
                        <?php if ( $product_permalink ) : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
                                <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                            </a>
                        <?php else : ?>
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                        <?php endif; ?>
                    </p>
                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                </div>

                <div class="cart-item-quantity">
                    <?php
                    if ( $_product->is_sold_individually() ) {
                        echo sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                        echo apply_filters( 'woocommerce_cart_item_quantity',
                            woocommerce_quantity_input(
                                array(
                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                    'input_value'  => $cart_item['quantity'],
                                    'max_value'    => $_product->get_max_purchase_quantity(),
                                    'min_value'    => '0',
                                    'product_name' => $_product->get_name(),
                                ),
                                $_product,
                                false
                            ),
                            $cart_item_key,
                            $cart_item
                        );
                    }
                    ?>
                </div>

                <div class="cart-item-subtotal">
                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                </div>

            </div>

            <?php endif; ?>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

            <div class="cart-actions">
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                <button type="submit" class="cart-update-button" name="update_cart"
                        value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                    カートを更新
                </button>
            </div>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>

        </div>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>

    </form>

    <!-- 合計・購入手続きボタン -->
    <div class="cart-footer">
        <div class="cart-footer-inner">
            <div class="cart-footer-total">
                <span class="cart-footer-label">合計（税込）</span>
                <span class="cart-footer-amount"><?php echo WC()->cart->get_total(); ?></span>
            </div>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="cart-checkout-button">
                購入手続きに進む
            </a>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_cart' ); ?>

</div>