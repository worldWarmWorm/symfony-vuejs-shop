<template>
	<div class="product">
		<div class="product-details">
			<h4 class="product-title">
				<a
						:href="urlShowProduct"
						target="_blank"
				>
					{{ cartProduct.product.title }}
				</a>
			</h4>
			<span class="product-info">
				<span class="product-quantity">
					{{ cartProduct.quantity }}
				</span>
				X {{ cartProduct.product.price }}
			</span>
		</div>
		<figure class="product-image-container">
			<a
				:href="urlShowProduct"
				target="_blank"
			>
				<img
					:src="getUrlProductImage(productImage)"
					class="product-image"
					:alt="cartProduct.product.title"
				>
			</a>
		</figure>
		<a
				href="#"
				class="btn-remove"
				title="Remove product"
				@click="removeCartProduct(cartProduct.id)"
		>
			X
		</a>
	</div>
</template>

<script>
	import {mapActions, mapState} from "vuex";
	import {concatUrlByParams} from "../../../../utils/url-generator";

	export default {
		name: "CartProductItem",
		props: {
			cartProduct: {
				type: Object,
				default: () => {
				}
			}
		},
		computed: {
			...mapState('cart', ['staticStore']),
			productImage() {
				const productImage = this.cartProduct.product.productImages;
				return productImage.length ? productImage[0] : null;
			},
			urlShowProduct() {
				return concatUrlByParams(
						this.staticStore.url.viewProduct,
						this.cartProduct.product.uuid
				);
			},
			productQuantityMax() {
				return parseInt(this.cartProduct.product.quantity);
			},
		},
		methods: {
			...mapActions('cart', ['removeCartProduct']),
			getUrlProductImage(productImage) {
				return concatUrlByParams(
						this.staticStore.url.assetImageProducts,
						this.cartProduct.product.id,
						productImage.filenameSmall
				);
			}
		}
	}
</script>