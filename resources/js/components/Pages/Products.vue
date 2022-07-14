<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">
            <div class="md:flex items-center pb-4 mb-4 border-b">
                <input type="text"
                       v-model="form.title"
                       class="mb-4 md:mb-0 w-full mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 hover:border-blue-600 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Title">

                <select
                    v-model="form.group_id"
                    class="mb-4 md:mb-0 w-full form-select appearance-none mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option v-for="group in groupsList" v-bind:value="group.id">{{ group.title }}</option>
                </select>

                <input type="text"
                       v-model="form.amount"
                       class="mb-4 md:mb-0 w-full mr-4 form-control block md:w-1/4 px-3 py-1 hover:border-blue-600 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Amount">

                <div
                    @click="storeProduct"
                    class="text-center border border-current hover:border-blue-600 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                    Create
                </div>
            </div>

            <ProductsTable
                :products-list="productsList"
                :groups-list="groupsList"
                @delete="getProductsList"
                @update="getProductsList"/>
        </div>
    </div>
</template>
<script>
import ProductsTable from "../views/ProductsTable";

export default {
    components: {ProductsTable},
    data() {
        return {
            productsList: null,
            groupsList: null,
            form: {
                title: null,
                group_id: null,
                amount: null,
            }
        }
    },
    created() {
        this.getGroupsList();
        this.getProductsList();
    },
    methods: {
        getGroupsList() {
            axios.get('groups', {params: {type: 'product'}})
                .then((res) => {
                    this.groupsList = res.data.data;
                })
        },
        getProductsList() {
            axios.get('products')
                .then((res) => {
                    this.productsList = res.data.data;
                })
        },
        storeProduct() {
            axios.post('products', this.form)
                .then((res) => {
                    if (res.status === 201) {
                        this.getProductsList();
                    }
                    this.form.title = null;
                    this.form.group_id = null;
                    this.form.amount = null;
                })
                .catch((error) => {
                    // console.log(error)
                });
        }
    }
}
</script>
