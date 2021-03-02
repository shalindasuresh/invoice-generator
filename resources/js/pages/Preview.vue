<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preview</div>

                    <div class="card-body">
                        <div id="preview">
                            <img v-if="url" :src="url" />
                        </div>
                        <span>{{this.sender}}</span>
                        <span>{{this.receiver}}</span>
                        <button @click="getInvoiceData">Click here</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: null,
            sender:null,
            receiver:null
        }
    },
    methods: {
        getInvoiceData(){ //final output from here
            this.invoice_data=this.$store.getters.getInvoiceData

            this.url = URL.createObjectURL(this.invoice_data.banner[0]);
            this.sender=this.invoice_data.sender
            this.receiver=this.invoice_data.receiver

        }
    }

}
</script>
