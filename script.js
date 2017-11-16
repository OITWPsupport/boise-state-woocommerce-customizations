/* PhotoSwipe Button Fix */
/* A11y fix for woocommerce-ordering (sort) form */
jQuery(document).ready(function() {
	jQuery('.pswp__button--close').attr('title', 'Close');
	jQuery('.pswp__button--share').attr('title', 'Share');
	jQuery('.pswp__button--fs').attr('title', 'Toggle fullscreen');
	jQuery('.pswp__button--zoom').attr('title', 'Zoom');
	jQuery('.pswp__button--arrow--left').attr('title', 'Previous (arrow left)');
	jQuery('.pswp__button--arrow--right').attr('title', 'Next (arrow right)');

	// We're going to hide the .woocommerce-ordering form (which lets us sort catalog items).
	// Still, we'll get wcag errors if we don't fix stuff on that form's elements
	jQuery('.woocommerce-ordering').append('<input type="submit" id="order-submit" value="Submit">');
	jQuery('.orderby').attr('title', 'orderby');
	// Hide the form:
	jQuery('.woocommerce-ordering').hide();

	jQuery('.sku_wrapper').hide();
	jQuery('.tagged_as').hide();
	jQuery('.page-numbers').attr('color', '#757575');
	jQuery('.page-numbers.current').attr('color', '#676767');
	jQuery('.skip-link').attr('color', '#feffff');

	jQuery('body').attr('font-family', '"Helvetica Neue", sans-serif');
	jQuery('.product_title').attr('font-family', '"Montserrat", sans-serif');
	jQuery('.related').attr('font-family', '"Montserrat", sans-serif');
	jQuery('.woocommerce-products-header__title').attr('font-family', '"Montserrat", sans-serif');

	// To hide a product's price from the product info page:
	jQuery('.woocommerce-Price-amount').hide();

	// To hide price-related elements from the checkout page:
	jQuery('.cart-subtotal').hide();
	jQuery('.order-total').hide();
	jQuery('.product-price').hide();
	jQuery('.product-subtotal').hide();
	jQuery('.cart_totals h2').hide();

	// To hide the "Out of stock" message on a product info page when inventory is zero:
	jQuery('.stock.out-of-stock').hide();

	// To hide the product's description on the product info page:
	jQuery('li#tab-title-description').hide();
	jQuery('div#tab-description').hide();

	// To hide the dollar amount in the top-right shopping cart summary:
	jQuery('.amount').hide();
});

