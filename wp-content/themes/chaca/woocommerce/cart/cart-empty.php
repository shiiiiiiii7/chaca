<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="cart-empty-wrapper">


    <div class="cart-empty-content">
        <p class="cart-empty-message">現在お買い物カゴには何も入っていません。</p>
        <a class="cart-empty-button" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
            Shop へ戻る
        </a>
    </div>

</div>