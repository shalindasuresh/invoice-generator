<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preview</div>

                    <div class="card-body">
                        <div id="preview">
                            <img v-if="this.invoice_data.url" :src="this.invoice_data.url"/>
                        </div>
                        <span>{{ this.invoice_data.sender }}</span>
                        <span>{{ this.invoice_data.receiver }}</span>
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
        // let   invoice_data={}
        return {
            invoice_data:{
                url:null,
                sender:null,
                receiver:null
            },
            isLoading: false,
            status: '',
            buttonText: "Send Invoice"
        }
    },
    components: {
        VueButtonSpinner
    },
    mounted: function () {
        const userData= this.$store.getters.getInvoiceData

        this.url =userData.banner_url
        this.invoice_data.sender =userData.sender
        this.invoice_data.receiver = userData.receiver


    },
    methods: {
        async sendInvoice() { //final output from here
            this.isLoading = true
            this.status = true // or s
            this.buttonText = "Sending"

            console.log(this.invoice_data);
            try {
                const resp = await axios.post('/send', this.invoice_data);
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
            }finally {
                // this.$router.push({ name: 'home' })
            }


        }
    }

}

</script>
