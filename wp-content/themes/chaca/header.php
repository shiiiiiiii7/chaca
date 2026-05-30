<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-inner">

        <!-- ロゴ・サイト名 -->
        <div class="site-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                Chaca
            </a>
        </div>

        <!-- ナビゲーション -->
        <nav class="site-nav">
            <ul class="nav-list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>">Shop</a></li>
                <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                <li>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="nav-cart-link">

                        Cart

                        <?php

                        $cart_count = 0;

                        if ( function_exists( 'WC' ) && WC()->cart ) {
                            $cart_count = WC()->cart->get_cart_contents_count();
                        }

                        ?>

                        <span class="cart-count"<?php echo $cart_count === 0 ? ' style="display:none"' : ''; ?>>
                            <?php echo esc_html( $cart_count ); ?>
                        </span>
                    </a>
                </li>            
            </ul>
        </nav>

    </div>
</header>
<?php wp_footer(); ?>
</body>
</html>