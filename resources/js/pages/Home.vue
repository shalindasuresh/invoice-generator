<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">Your Online Invoicing Tool</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="input-group">
                                    <picture-input ref="banner_img" @change="selectFile" width="200" height="200"
                                                   accept="image/jpeg,image/png" size="100"
                                                   :removable="true" :customStrings="{drag: 'Your Logo here'}">
                                    </picture-input>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
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

                        <div class="form-row mb-3 mt-3">
                            <div class="col-3">
                                <input type="text" v-model="invoice_data.sender" class="form-control"
                                       placeholder="Invoice From"/>
                            </div>
                            <div class="col-3">
                                <input type="text" v-model="invoice_data.receiver" class="form-control"
                                       placeholder="Invoice To"/>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">

                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col text-center">Item</th>
                                        <th scope="col text-center">Quantity</th>
                                        <th scope="col text-center">Rate</th>
                                        <th scope="col text-center">Amount</th>
                                        <th scope="col text-center">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in invoice_data.items ">
                                        <td><input type="text" v-model="item.name"/></td>
                                        <td><input type="text" v-model="item.qty"/></td>
                                        <td><input type="text" v-model="item.rate"/></td>
                                        <td class="row"><input type="text" disabled  :value="lineTotal[index]"/></td>
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


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Notes" >
                            </div>
                            <div class="form-group col-md-6">
                                <label >Sub Total</label>
                                <label >${{total}}</label>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" placeholder="Terms">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control"  placeholder="Amount Paid">

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
    computed: {
        lineTotal() {
            return this.invoice_data.items.map((item) => {
                return Number(item.qty * item.rate)
            });
        },
        total() {
            return this.invoice_data.items.reduce((total, item) => {
                return total + item.qty * item.rate;
            }, 0);
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
