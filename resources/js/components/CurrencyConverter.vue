<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Currency converter</div>

				<div class="card-body">
					<div class="form-group">
						<label for="start_currency">Starting currency</label>
						<select class="form-control" name="start_currency" v-model="startCurrency">
							<option v-for="(curr, index) in currencyOptions">{{ curr }}</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";

export default {
	data() {
		return {
            currencyOptions: [1,2,3],
			startCurrency: 1,
			endCurrency: "USD",
			result: 0
		};
	},
	methods: {
		fetchResult() {}
	},
	mounted() {}
};
</script>
