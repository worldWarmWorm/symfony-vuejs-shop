<template>
	<div class="row mb-1 mt-3">
		<div class="col-md-12 font-weight-bold">
			Total price: <span class="font-weight-bold">${{totalPrice}}</span>
		</div>
	</div>
</template>

<script>
	import {mapState} from "vuex";

	export default {
		name: "TotalPriceBlock",
		computed: {
			...mapState("products", ["orderProducts"]),
			totalPrice() {
				let totalPrice = 0;
				if (this.orderProducts) {
					this.orderProducts.forEach(orderProduct => {
						totalPrice += parseFloat(orderProduct.pricePerOne) * orderProduct.quantity;
					});
				}
				return parseFloat(totalPrice.toFixed(2));
			}
		}
	}
</script>

<style scoped>

</style>