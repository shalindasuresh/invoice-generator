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
                                <figure class="figure image-placeholder"  v-bind:style='{ backgroundImage: "url(" + url + ")", }'>
                                    <input type="file" id="uploadImage" ref="myFiles" class="custom-file-input" @change="selectFile" >
                                    <figcaption class="figure-caption">Select Banner</figcaption>
                                </figure>
                            </div>

                            <div class="col-md-6">


                                <input v-model="sender" placeholder="Sender Email">
                                <input v-model="receiver" placeholder="Receiver Email">
                                <date-pick v-model="date"   :isDateDisabled="isPastDate"></date-pick>
                                <router-link class="nav-link" data-toggle="collapse" :to="{ name: 'preview' }">Preview
                                </router-link>
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
            files: [],
            sender: null,
            receiver: null,
            url:null,
            date: new Date().toDateString("yyyy-MM-dd"),
        }
    },
    methods: {
        selectFile() {

            this.files = this.$refs.myFiles.files
            this.url = URL.createObjectURL(this.files[0]);
            this.$store.dispatch("addData", [this.files, this.sender, this.receiver])
        },
        isPastDate(date) {
            const currentDate = new Date();
            return date < currentDate;
        }
    }
}
</script>
