<template>
	<div class="row">
		<div class="col-lg-12 order-block">
			<div class="order-content">
				<Notify/>
				<div v-if="showCartContent">
					<CartProductList/>
					<CartTotalPrice/>
					<a
							class="btn btn-success mb-3 text-white"
							@click="makeOrder"
					>
						MAKE ORDER
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import CartProductList from "./components/CartProductList";
	import CartTotalPrice from "./components/CartTotalPrice";
	import {mapActions, mapState} from "vuex";
	import Notify from "./components/Notify";

	export default {
		name: 'App',
		components: {Notify, CartTotalPrice, CartProductList},
		created() {
			this.getCart();
		},
		computed: {
			...mapState('cart', ['cart', 'isSentForm']),
			showCartContent() {
				return !this.isSentForm && Object.keys(this.cart).length;
			}
		},
		methods: {
			...mapActions('cart', ['getCart', 'makeOrder'])
		}
	}
</script>