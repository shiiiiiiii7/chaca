<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
    $product    = wc_get_product( get_the_ID() );
    $product_id = get_the_ID();
    $managing   = $product->managing_stock();
    $stock      = $managing ? $product->get_stock_quantity() : null;
    $is_out     = $managing && $stock <= 0;
?>

<main class="single-product-main">
    <div class="product-detail">

        <div class="product-detail-image">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>

        <div class="product-detail-info">

            <h1 class="product-detail-name"><?php the_title(); ?></h1>

            <p class="product-detail-price">
                <?php echo wc_price( $product->get_price() ); ?>
            </p>

            <?php if ( $managing ) : ?>
            <p class="product-detail-stock"
               data-product-id="<?php echo esc_attr( $product_id ); ?>"
               data-stock="<?php echo esc_attr( $stock ); ?>">
                <?php echo $stock > 0 ? '在庫' . $stock . '個' : '在庫切れ'; ?>
            </p>
            <div class="product-detail-cart">
                <a href="<?php echo esc_url( '?add-to-cart=' . $product_id ); ?>"
                    data-quantity="1"
                    class="single_add_to_cart_button add_to_cart_button ajax_add_to_cart product_type_simple<?php echo $is_out ? ' disabled' : ''; ?>"
                    data-product_id="<?php echo esc_attr( $product_id ); ?>"
                    <?php echo $is_out ? 'aria-disabled="true"' : ''; ?>
                >
                    <?php echo $is_out ? '在庫切れ' : 'カートに追加'; ?>
                </a>
            </div>             
            <?php endif; ?>

            <div class="product-detail-description">
                <?php the_content(); ?>
            </div>


        </div>
    </div>
</main>

<?php endwhile; ?>
<?php get_footer(); ?>

