export default {

    state: {

        invoice_data: []

    },

    getters: {

        getInvoiceData(state) { //take parameter state

            return state.invoice_data
        }
    },

    actions: {
        addData(context, data) {

            // axios.get("api/category")
            //
            //     .then((response)=>{
            //         console.log(response.data.categories)

            context.commit("categories", data) //categories will be run from mutation

            // })
            //
            // .catch(()=>{
            //
            //     console.log("Error........")
            //
            // })
        }
    },

    mutations: {
        categories(state, data) {

            [state.invoice_data.banner, state.invoice_data.sender,  state.invoice_data.receiver] = data

        }
    }
}
