<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preview</div>

                    <div class="card-body">
                        <div id="preview">
                            <img v-if="url" :src="url"/>
                        </div>
                        <span>{{ this.sender }}</span>
                        <span>{{ this.receiver }}</span>
                        <!--                        <button @click="getInvoiceData">Click here</button>-->


                        <vue-button-spinner
                            v-bind="{isLoading, status}"
                            :disabled="isLoading"
                            @click.native="sendInvoice"
                        >
                            <span>{{ buttonText }}</span>
                        </vue-button-spinner>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueButtonSpinner from 'vue-button-spinner';

export default {
    data() {
        return {
            url: null,
            sender: null,
            receiver: null,
            isLoading: false,
            status: '',
            buttonText: "Send Invoice"
        }
    },
    components: {
        VueButtonSpinner
    },
    mounted: function () {
        this.invoice_data = this.$store.getters.getInvoiceData

        this.url = URL.createObjectURL(this.invoice_data.banner[0]);
        this.sender = this.invoice_data.sender
        this.receiver = this.invoice_data.receiver


    },
    methods: {
        async sendInvoice() { //final output from here
            this.isLoading = true
            this.status = true // or s
            this.buttonText = "Sending"

            try {
                const resp = await axios.post('/test', {});
                console.log(resp.data);

                this.isLoading = false
                this.status = true // or s
                this.buttonText = "Success"
            } catch (err) {
                // Handle Error Here
                console.error(err);
                this.isLoading = false
                this.status = true // or s
                this.buttonText = "Error"
            }


        }

        //     this.axios
        //         .post('http://localhost:8000/api/products', this.product)
        //         .then(response => (
        //             // this.$router.push({ name: 'home' })
        //             this.isLoading = true
        //             this.status = true // or s
        //             this.buttonText = "Sending"
        // ))
        // .
        //     catch(err => console.log(err))
        //         .finally(() => this.loading = false)
        // }
    }

}

</script>
