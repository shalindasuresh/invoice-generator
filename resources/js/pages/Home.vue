<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">INVOICE</div>
                    <!--                    Primary Invoice Container-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 float-left">
                                <div class="input-group">
                                    <picture-input ref="banner_img" @change="selectFile" width="200" height="200"
                                                   margin="16" accept="image/jpeg,image/png" size="100"
                                                   :removable="true" :customStrings="{drag: 'Your Logo here'}">
                                    </picture-input>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group float-right">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input v-model="invoice_data.invoice_number" placeholder="Invoice Number">
                                </div>
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Invoice Date</span>
                                    </div>

                                    <date-pick v-model="invoice_data.date" :isDateDisabled="isPastDate"></date-pick>
                                </div>

                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Due Date</span>
                                    </div>

                                    <date-pick v-model="invoice_data.due_date" :isDateDisabled="isPastDate"></date-pick>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mt-3">
                                    <input type="text" v-model="invoice_data.sender" class="form-control"
                                           placeholder="Invoice From"/>
                                </div>
                                <div class="input-group mt-3">
                                    <input type="text" v-model="invoice_data.receiver" class="form-control"
                                           placeholder="Invoice To"/>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in invoice_data.items ">
                                        <td><input type="text" v-model="item.name"/></td>
                                        <td><input type="text" v-model="item.qty"/></td>
                                        <td><input type="text" v-model="item.rate"/></td>
                                        <td class="row"><input type="text" v-model="item.amount"/></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" @click="removeRow(index)">X
                                            </button>
                                        </td>

                                    </tr>
                                    </tbody>
                                    <button type="button" class="btn btn-info" @click="addRow()">Add Item</button>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <button type="button" class="btn btn-secondary" @click="previewPage()">Preview Invoice
                                </button>
                            </div>
                            <div class="col-md-6"></div>
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
import PictureInput from 'vue-picture-input'

export default {
    components: {DatePick, PictureInput},

    data() {
        return {
            invoice_data: {
                items: [{}]
            },
            date: new Date().toDateString("yyyy-MM-dd"),
        }
    },
    methods: {

        previewPage() {
            this.$store.dispatch("addData", this.invoice_data)
            this.$router.push({path: '/preview'});
        },

        selectFile() {
            this.invoice_data.banner_file = this.$refs.banner_img.image
        },
        isPastDate(date) {
            const currentDate = new Date();
            return date < currentDate;
        },
        addRow() {

            this.invoice_data.items.push({});
        },

        removeRow(index) {
            this.invoice_data.items.splice(index, 1);
        }
    }
}
</script>
