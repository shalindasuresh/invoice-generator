<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preview</div>

                    <div class="card-body">
                        <div id="preview">
                            <img v-if="this.invoice_data.banner_url" :src="this.invoice_data.banner_url"/>
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
                banner_url:null,
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
        this.invoice_data.banner_file =userData.banner_file
        this.invoice_data.banner_url =userData.banner_url
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

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData()
                data.append('banner_file',this.invoice_data.banner_file)
                data.append('sender',this.invoice_data.sender)
                data.append('receiver',this.invoice_data.receiver)

                const resp = await axios.post('/send',  data, config)

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
