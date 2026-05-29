<?php get_header(); ?>
<main class="shop-main">
    <!-- <div class="shop-hero">
        <h1 class="shop-title">Shop</h1>
        <p class="shop-sub">Bean to Bar Chocolate</p>
    </div> -->
    <div class="shop-container">
        <?php if ( woocommerce_product_loop() ) : ?>
            <ul class="products-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    $product_obj = wc_get_product( get_the_ID() );
                    $stock    = 999;
                    $managing = false;
                    if ( $product_obj && $product_obj->managing_stock() ) {
                        $stock    = $product_obj->get_stock_quantity();
                        $managing = true;
                    }
                    ?>
                    <li class="product-item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-image"><?php the_post_thumbnail( 'medium' ); ?></div>
                            <div class="product-info">
                                <h2 class="product-name"><?php the_title(); ?></h2>
                                <p class="product-price"><?php echo wc_price( get_post_meta( get_the_ID(), '_regular_price', true ) ); ?></p>
                                <?php if ( $managing ) : ?>
                                    <?php $is_out = $stock <= 0; ?>
                                    <a class="product-stock add_to_cart_button ajax_add_to_cart product_type_simple<?php echo $is_out ? ' disabled' : ''; ?>"
                                       href="<?php echo esc_url( '?add-to-cart=' . get_the_ID() ); ?>"
                                       data-product_id="<?php echo esc_attr( get_the_ID() ); ?>"
                                       data-quantity="1"
                                       data-stock="<?php echo esc_attr( $stock ); ?>"
                                       <?php echo $is_out ? 'aria-disabled="true" onclick="return false;"' : ''; ?>>
                                        <?php echo $stock > 0 ? '在庫' . $stock . '個' : '在庫切れ'; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p class="no-products">現在在庫はありません。</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>