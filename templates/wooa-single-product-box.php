<div class="wooa-product-item-style-1  <?php echo $product_data['is_sale'] ? 'is-sale' : '' ?>">

	<a href="<?php echo $product_data['url'] ?>" title="<?php echo $product_data['title'] ?>" class="wooa-product-item-style-1__image-container">

		<?php echo $product_data['is_sale'] ? '<span>Sale</span>' : '' ?>

		<?php echo $product_data['image'] ?>

	</a>

	<a href="<?php echo $product_data['url'] ?>" title="<?php echo $product_data['title'] ?>" class="wooa-product-item-style-1__content">

		<h5 class="wooa-product-item-style-1__title"><?php echo $product_data['title'] ?></h5>

		<div class="wooa-product-item-style-1__prices">

			<div class="wooa-product-item-style-1__regular-price"><?php echo $product_data['currency'] . $product_data['regular_price'] ?></div>

			<div class="wooa-product-item-style-1__sale-price"><?php echo $product_data['currency'] . $product_data['sale_price'] ?></div>

		</div>

	</a>

	<div class="wooa-product-item-style-1__add-to-cart"> <a><?php _e('ADD TO CART',WOOA_TEXT_DOMAIN) ?></a></div>
</div>