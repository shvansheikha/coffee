<template>
    <div class="px-4">
        <div class="mb-1 pb-1 w-auto">Product</div>

        <form @submit.prevent="submitOrder">
            <div class="md:flex items-center pb-1 mb-1">
                <select
                    v-model="productGroupID"
                    class="mb-2 md:mb-0 form-select appearance-none mr-4 form-control block w-full md:w-2/6 px-3 py-0.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option disabled value="">Please select</option>
                    <option v-for="group in productGroupsList" v-bind:value="group.id">{{ group.title }}</option>
                </select>

                <select
                    v-model="productForm.orderable"
                    class="mb-2 md:mb-0 form-select appearance-none mr-4 form-control block w-full md:w-2/6 px-3 py-0.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option v-for="product in productList" v-bind:value="product.id">{{ product.title }}</option>
                </select>

                <input type="text"
                       v-model="productForm.number"
                       class="mb-2 md:mb-0 mr-4 form-control block w-full md:w-1/6 px-3 py-0.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none"
                       placeholder="Number">

                <button type="submit"
                        class="mb-2 md:mb-0 w-full md:w-1/6 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-0.5">
                    Order
                </button>
            </div>
        </form>
    </div>
</template>
<script>

import axios from 'axios';

export default {
    name: 'OrderProductForm',
    props: {basket: Object},
    data() {
        return {
            productGroupID: '',
            productList: null,
            productGroupsList: null,
            productForm: {
                orderable: null,
                type: "product",
                number: 1,
            }
        }
    },
    watch: {
        productGroupID() {
            this.getProducts();
        }
    },
    created() {
        this.getProductGroupsList();
    },
    methods: {
        getProductGroupsList() {
            axios.get('/api/groups', {params: {type: 'product'}})
                .then((res) => {
                    this.productGroupsList = res.data.data;
                })
        },
        getProducts() {
            axios.get('/api/products', {params: {group: this.productGroupID}})
                .then((res) => {
                    this.productList = res.data.data;
                    this.productForm.orderable = this.productList[0].id
                })
        },
        submitOrder() {
            this.$inertia.post('/' + this.basket.id + '/orders', this.productForm, {
                preserveState: false
            })
        }
    }
}
</script>
