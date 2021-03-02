<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">

                        <input type="file" id="uploadImage" ref="myFiles" class="custom-file-input" @change="selectFile" multiple>

                        <input v-model="sender" placeholder="Sender Email">
                        <input v-model="receiver" placeholder="Receiver Email">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'preview' }"
                        >
                            Preview
                        </router-link>


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
            files: [],
            sender:null,
            receiver:null
        }
    },
    methods: {
        selectFile() {

            this.files = this.$refs.myFiles.files

            this.$store.dispatch("addData",[this.files,this.sender,this.receiver])

            // console.log(this.files)
        }
    }

}
</script>
