<template>
  <div class="row mb-1 mt-1">
	  <hr>
    <div class="col-md-1 justify-content-center align-items-center d-flex">
      {{ rowNumber }}
    </div>
    <div class="col-md-3 align-items-center d-flex">
			{{ productTitle }}
    </div>
    <div class="col-md-2 align-items-center d-flex">
	    {{ categoryTitle }}
    </div>
    <div class="col-md-1 align-items-center d-flex">
			{{ orderProduct.quantity }}
    </div>
    <div class="col-md-2 align-items-center d-flex">
			${{ orderProduct.pricePerOne }}
    </div>
    <div class="col-md-3 align-items-center d-flex">
	    <button class="btn btn-outline-info mr-1" @click="viewDetails">Details</button>
	    <button class="btn btn-outline-success" @click="remove">Remove</button>
    </div>
	  <hr>
  </div>
</template>

<script>
	import {mapActions, mapState} from "vuex";
	import { getUrlViewProduct } from "../../../../utils/url-generator";
	import {getProductInforvativeTitle} from "../../../../utils/title-formatter";

  export default {
    name: "OrderProductItem",
    props: {
      orderProduct: {
        type: Object,
        default: () => {}
      },
      index: {
        type: Number,
        default: 0
      }
    },
	  computed: {
			...mapState("products", ["staticStore"]),
			rowNumber() {
				return this.index + 1;
			},
		  productTitle() {
			  return getProductInforvativeTitle(this.orderProduct.product);
		  },
		  categoryTitle() {
				return this.orderProduct.product.category.title;
		  }
	  },
	  methods: {
			...mapActions("products", ["removeOrderProduct"]),
		  viewDetails(event) {
			  event.preventDefault();
				const url = getUrlViewProduct(this.staticStore.url.viewProduct, this.orderProduct.product.id);
				window.open(url, "_blank").focus();
		  },
		  remove(event) {
				event.preventDefault();
				this.removeOrderProduct(this.orderProduct.id);
		  }
	  }
  }
</script>