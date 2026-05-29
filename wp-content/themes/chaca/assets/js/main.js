document.addEventListener('DOMContentLoaded', function () {

    // ヒーローアニメーション
    const hero      = document.querySelector('.hero');
    const panelLeft = document.querySelector('.hero-panel-left');
    const panelRight = document.querySelector('.hero-panel-right');
    const heroInner = document.querySelector('.hero-inner');
    const heroScroll = document.querySelector('.hero-scroll');
    const header    = document.querySelector('.site-header');

    if (hero) {

        setTimeout(function () { hero.classList.add('is-loaded'); }, 100);

        window.addEventListener('scroll', function () {
            const scrollY      = window.scrollY;
            const maxScroll    = window.innerHeight;
            const openProgress = Math.min(scrollY / (maxScroll * 0.8), 1);
            const moveX        = openProgress * 100;

            panelLeft.style.transform  = `translateX(-${moveX}%)`;
            panelRight.style.transform = `translateX(${moveX}%)`;

            if (openProgress >= 1) {
                hero.style.position = 'absolute';
                hero.style.top      = `${maxScroll * 0.8}px`;
                const slideStart    = maxScroll * 0.8;
                const slideProgress = Math.min(Math.max(scrollY - slideStart, 0) / (maxScroll * 0.2), 1);
                const moveY         = slideProgress * 100;
                hero.style.transform = `translateY(-${moveY}vh)`;
            } else {
                hero.style.position  = 'fixed';
                hero.style.top       = '0';
                hero.style.transform = 'none';
            }

            const textOpacity = Math.max(1 - openProgress * 2, 0);
            if (heroInner)  heroInner.style.opacity  = textOpacity;
            if (heroScroll) heroScroll.style.opacity = textOpacity;

            if (openProgress > 0.3) {
                header.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            } else {
                header.style.backgroundColor = 'transparent';
            }
        
        });
    } 
    // ============================================================
    // Aboutスクロールアニメーション
    // ============================================================
    
    const animTargets = document.querySelectorAll('.js-fadeup, .js-slide-right, .js-slide-left');
    const animObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                animObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    animTargets.forEach(function (el) { animObserver.observe(el); });
    
    const lines = document.querySelectorAll('.js-line');
    const lineObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const allLines = Array.from(document.querySelectorAll('.js-line'));
                const index    = allLines.indexOf(entry.target);
                setTimeout(function () { entry.target.classList.add('is-visible'); }, index * 180);
                lineObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    lines.forEach(function (line) { lineObserver.observe(line); });
});



// ============================================================
// 商品詳細ページ：在庫数リアルタイム更新
// ============================================================

// ============================================================
// 商品詳細ページ：在庫数リアルタイム更新
// ============================================================

// 修正後：ローカルデクリメントをやめ、即座にAJAXで実在庫を取得する
jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {

    var productId = $button.data('product_id');

    var stockEl = document.querySelector('.product-detail-stock[data-product-id="' + productId + '"]');
    if (!stockEl) {
        stockEl = document.querySelector('.product-stock[data-product_id="' + productId + '"]');
    }
    if (!stockEl) return;

    // サーバーから実際の在庫を取得して表示を更新
    jQuery.post(ajaxurl, {
        action: 'get_product_stock',
        product_id: productId
    }, function(response) {
        if (!response.success) return;

        var newStock = response.data.stock;
        stockEl.setAttribute('data-stock', newStock);

        if (newStock <= 0) {
            stockEl.textContent = '在庫切れ';
            stockEl.classList.add('disabled');
            stockEl.setAttribute('aria-disabled', 'true');
            if (stockEl.tagName === 'A') {
                stockEl.onclick = function() { return false; };
            }
            $button
                .addClass('disabled')
                .attr('aria-disabled', 'true')
                .text('在庫切れ');
        } else {
            stockEl.textContent = '在庫' + newStock + '個';
            stockEl.classList.remove('disabled');
            stockEl.removeAttribute('aria-disabled');
        }
    });
});

// ============================================================
// カート更新ボタン：数量変更時に有効化
// ============================================================
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('qty')) {
        var updateBtn = document.querySelector('.cart-update-button');
        if (updateBtn) {
            updateBtn.disabled = false;
            updateBtn.classList.remove('disabled');
        }
    }
});

// ============================================================
// 在庫情報の定期同期
// ============================================================

function updateStockDisplay() {
    // single-product（詳細ページ）の在庫要素を取得
    var detailStocks = document.querySelectorAll('.product-detail-stock[data-product-id]');
    
    // archive-product（一覧ページ）の在庫要素を取得
    var archiveStocks = document.querySelectorAll('.product-stock[data-product_id]');
    
    // 両方を結合
    var allStocks = Array.from(detailStocks).concat(Array.from(archiveStocks));
    
    if (allStocks.length === 0) return;
    
    // 各製品の在庫をAJAXで取得して更新
    allStocks.forEach(function(stockEl) {
        var productId = stockEl.getAttribute('data-product-id') || stockEl.getAttribute('data-product_id');
        
        jQuery.post(ajaxurl, {
            action: 'get_product_stock',
            product_id: productId
        }, function(response) {
            if (!response.success) return;
            
            var newStock = response.data.stock;
            var currentStock = parseInt(stockEl.getAttribute('data-stock')) || 0;
            
            // 在庫が変更された場合のみ更新
            if (newStock !== currentStock) {
                stockEl.setAttribute('data-stock', newStock);
                
                if (newStock <= 0) {
                    stockEl.textContent = '在庫切れ';
                    stockEl.classList.add('disabled');
                    stockEl.setAttribute('aria-disabled', 'true');
                    if (stockEl.tagName === 'A') {
                        stockEl.onclick = function() { return false; };
                    }
                } else {
                    stockEl.textContent = '在庫' + newStock + '個';
                    stockEl.classList.remove('disabled');
                    stockEl.removeAttribute('aria-disabled');
                    if (stockEl.tagName === 'A') {
                        stockEl.onclick = null;
                    }
                }
            }
        });
    });
}

// ページ読み込み時と5秒ごとに在庫を同期
if (document.querySelectorAll('.product-detail-stock[data-product-id], .product-stock[data-product_id]').length > 0) {
    updateStockDisplay();
    setInterval(updateStockDisplay, 5000);
}

// WooCommerceのカート更新イベント時にも同期
jQuery(document.body).on('updated_wc_div', function() {
    updateStockDisplay();
});