<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">INVOICE</div>
                    <!--                    Primary Invoice Container-->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <figure class="figure image-placeholder"  v-bind:style='{ backgroundImage: "url(" + this.invoice_data.banner_url + ")", }'>
                                    <input type="file" id="uploadImage" ref="banner_img" class="custom-file-input" @change="selectFile" >
                                    <figcaption class="figure-caption">Select Banner</figcaption>
                                </figure>
                            </div>

                            <div class="col-md-6">


                                <input v-model="invoice_data.sender" placeholder="Sender Email">
                                <input v-model="invoice_data.receiver" placeholder="Receiver Email">
                                <date-pick v-model="invoice_data.date"   :isDateDisabled="isPastDate"></date-pick>
                                <button @click="previewPage()">Preview</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';

export default {
    components: {DatePick},

    data() {
        return {
            invoice_data:{
                // sender:null,
                // receiver:null,
                // banner_url:null,
            },
            date: new Date().toDateString("yyyy-MM-dd"),
        }
    },
    methods: {

        previewPage() {
            this.$store.dispatch("addData", this.invoice_data)
            this.$router.push({ path: '/preview' });
        },

        selectFile() {
            const bannerImage = this.$refs.banner_img.files[0]
            this.invoice_data.banner_url = URL.createObjectURL(bannerImage);
        },
        isPastDate(date) {
            const currentDate = new Date();
            return date < currentDate;
        }
    }
}
</script>
