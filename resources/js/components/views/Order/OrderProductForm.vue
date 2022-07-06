<template>
    <div class="p-4">
        <div class="mb-2 pb-2 w-auto">Product</div>
        <div class="flex items-center pb-2 mb-2">

            <select
                v-model="productGroupID"
                class="form-select appearance-none mr-4 form-control block w-2/6 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                <option v-for="group in productGroupsList" v-bind:value="group.id">{{ group.title }}</option>
            </select>

            <select
                v-model="productForm.orderable"
                class="form-select appearance-none mr-4 form-control block w-2/6 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                <option v-for="product in productList" v-bind:value="product.id">{{ product.title }}</option>
            </select>

            <input type="text"
                   v-model="productForm.number"
                   class="mr-4 form-control block w-1/6 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none"
                   placeholder="Number">

            <div @click="submitOrder"
                 class="w-1/6 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                Order
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'OrderProductForm',
    props: ['basket'],
    data() {
        return {
            productGroupID: null,
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
            axios.get('groups', {params: {type: 'product'}})
                .then((res) => {
                    this.productGroupsList = res.data.data;
                })
        },
        async getProducts() {
            await axios.get('products', {params: {group: this.productGroupID}})
                .then((res) => {
                    this.productList = res.data.data;
                })
        },
        submitOrder() {
            axios.post(this.basket + '/orders', this.productForm)
                .then((res) => {
                    this.$emit('updateProduct');
                })
        }
    }
}
</script>
