<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Currency converter</div>

				<div class="card-body">

                    
                    <div class="form-group">
						<label for="start_value">Start value</label>
						<input type="text" name="start_value" class="form-control" v-model="startValue">
					</div>

					<div class="form-group">
						<label for="start_currency">Starting currency</label>
						<select class="form-control" name="start_currency" v-model="startCurrency">
							<option v-for="(curr, index) in currencyOptions">{{ curr }}</option>
						</select>
					</div>

                    <div class="form-group">
						<label for="end_currency">Ending currency</label>
						<select class="form-control" name="end_currency" v-model="endCurrency">
							<option v-for="(curr, index) in currencyOptions">{{ curr }}</option>
						</select>
					</div>

                    <div class="my-3" v-if="result">
                        <strong class="text-success">{{ result }}</strong>
                    </div>

                    <a href="#" class="btn btn-primary" @click.prevent="fetchResult">Calculate</a>

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
            currencyOptions: [],
            startValue: null,
			startCurrency: "GBP",
			endCurrency: "USD",
            result: null,
            resultString: ""
		};
	},
	methods: {
        fetchResult() 
        {
            if(!this.startValue)
            {
                return alert('Please enter a starting value');
            }

            let vm = this;

            axios.get('/api/currency', {
                params: {
                    from: vm.startCurrency,
                    to: vm.endCurrency,
                    value: vm.startValue
                }
            })
            .then(function(response) {
                vm.result = response.data;
            });
        },
        fetchCurrencies()
        {
            let vm = this;

            axios.get('/api/currencies').then(function(response) {
                vm.currencyOptions = response.data;
            });
        }
	},
    mounted()
    {
        this.fetchCurrencies();
    }
};
</script>
