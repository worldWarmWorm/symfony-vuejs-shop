<template>
	<div
			v-if="notify.message"
			:class="alertClass"
	>
		{{notify.message}}
	</div>
</template>

<script>
	import {mapState} from "vuex";

	export default {
		name: 'Notify',
		computed: {
			...mapState('cart', ['notify']),
			alertClass() {
				return `alert alert-${this.notify.type}`;
			}
		}
	}
</script>