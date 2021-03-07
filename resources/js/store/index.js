export default {

    state: {

        invoice_data: []

    },

    getters: {

        getInvoiceData(state) { //take parameter state
            console.log(state.invoice_data)
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

            state.invoice_data= data
        }
    }
}
