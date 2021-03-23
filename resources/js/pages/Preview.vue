<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Invoice Preview</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div id="preview">
                                    <img v-if="this.invoice_data.banner_file" :src="this.invoice_data.banner_file"/>
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ this.invoice_data.sender }}</span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-black-50">Bill To</span>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">{{ this.invoice_data.receiver }}</span>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <span class="text-black-50">Ship To</span>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">{{ this.invoice_data.receiver }}</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <h2>INVOICE</h2>

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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in invoice_data.items ">
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.qty }}</td>
                                        <td>{{ item.rate }}</td>
                                        <td class="row">{{ lineTotal[index] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                            </div>

                            <div class="col-md-6">
                                <p>
                                    <span>Total Amount :{{ total }}</span>
                                </p>
                                <p>
                                    <span>Amount Paid :{{ invoice_data.amount_paid }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Notes</label>
                                <p>{{ invoice_data.notes }}</p>
                            </div>
                            <div class="col-md-12">
                                <label>Terms</label>
                                <p>{{ invoice_data.terms }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <vue-button-spinner v-bind="{isLoading, status}" :disabled="isLoading" class="btn btn-primary"
                                                    @click.native="sendInvoice">
                                    <span>{{ buttonText }}</span>
                                </vue-button-spinner>
                            </div>
                        </div>
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
            invoice_data: {
                sender: null,
                receiver: null,
                banner_file: null,
                amount_paid: 0,
                items: null,
                notes: null,
                terms: null
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
        const userData = this.$store.getters.getInvoiceData
        this.invoice_data.banner_file = userData.banner_file
        this.invoice_data.items = userData.items;
        this.invoice_data.sender = userData.sender
        this.invoice_data.date = userData.receiver
        this.invoice_data.due_date = userData.receiver
        this.invoice_data.balance = userData.receiver
        this.invoice_data.receiver = userData.receiver
        this.invoice_data.amount_paid = userData.amount_paid
        this.invoice_data.notes = userData.notes
        this.invoice_data.terms = userData.terms
    },

    computed: {
        lineTotal() {
            return this.invoice_data.items.map((item) => {
                const itemTotal = Number(item.qty * item.rate);
                return isNaN(itemTotal) ? 0.00 : itemTotal
            });
        },
        total() {
            return this.invoice_data.items.reduce((total, item) => {
                const subTotal = total + item.qty * item.rate;
                return subTotal
            }, 0);
        },

        balance() {

            const balanceDue = Number(this.total - this.invoice_data.amount_paid);
            return isNaN(balanceDue) ? 0.00 : balanceDue

        }
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
                data.append('banner_file', this.invoice_data.banner_file)
                data.append('sender', this.invoice_data.sender)
                data.append('receiver', this.invoice_data.receiver)
                data.append('total', this.total)
                data.append('amount_paid', this.invoice_data.amount_paid)
                data.append('notes', this.invoice_data.notes)
                data.append('terms', this.invoice_data.terms)
                data.append('date', this.invoice_data.date)
                data.append('due_date', this.invoice_data.due_date)
                data.append('balance', this.invoice_data.balance)
                data.append('items',  JSON.stringify(this.invoice_data.items))

                const resp = await axios.post('/send', data, config)

                this.isLoading = false
                this.status = true // or s
                this.buttonText = "Success"
            } catch (err) {
                // Handle Error Here
                console.error(err);
                this.isLoading = false
                this.status = true // or s
                this.buttonText = "Error"
            } finally {
                // this.$router.push({ name: 'home' })
            }


        }
    }

}

</script>
