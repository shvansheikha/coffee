<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <form @submit.prevent="submit">
                <div class="md:flex items-center pb-4 mb-4 border-b">
                    <input type="text"
                           v-model="form.title"
                           class="mb-4 md:mb-0 w-full mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 hover:border-blue-600 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Product Title">

                    <select
                        v-model="form.group_id"
                        class="mb-4 md:mb-0 w-full form-select appearance-none mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                        <option disabled value="">Please select</option>
                        <option v-for="group in groups" v-bind:value="group.id">{{ group.title }}</option>
                    </select>

                    <input type="text"
                           v-model="form.amount"
                           class="mb-4 md:mb-0 w-full mr-4 form-control block md:w-1/4 px-3 py-1 hover:border-blue-600 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Product Amount">

                    <button
                        type="submit"
                        class="text-center border border-current hover:border-blue-600 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                        Create
                    </button>
                </div>
            </form>

            <ProductsTable :products-list="filteredList" :groups-list="groups"/>
        </div>
    </div>
</template>
<script>
import ProductsTable from "../views/ProductsTable.vue";

export default {
    name: 'Products',
    components: {ProductsTable},
    props: {
        products: Array,
        groups: Array
    },
    data() {
        return {
            form: {
                title: null,
                group_id: '',
                amount: null,
            }
        }
    },
    computed: {
        filteredList() {
            if (this.form.title) {
                return this.products.filter((item) => {
                    return this.form.title.toLowerCase().split(' ').every(v => item.title.toLowerCase().includes(v))
                });
            } else {
                return this.products;
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/products', this.form, {
                preserveState: false,
                onSuccess: () => {
                    this.form.title = null;
                    this.form.group_id = '';
                    this.form.amount = null;
                }
            });
        }
    }
}
</script>
