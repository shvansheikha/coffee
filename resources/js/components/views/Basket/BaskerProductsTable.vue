<template>
    <div
        v-if="productsList != null && productsList.length > 0"
        class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded-md shadow-md">
        <div
            class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

            <div class="text-center px-3 py-3 md:w-1/12">
                #
            </div>

            <div class="px-3 py-3 md:w-3/12">
                Product
            </div>

            <div class="px-3 py-3 md:w-3/12">
                Count
            </div>

            <div class="px-3 py-3 md:w-2/12">
                Amount
            </div>

            <div class="px-3 py-3 md:w-1/12">
                Price
            </div>
        </div>

        <div v-for="(order, index) in productsList"
             class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
             :class="(index === productsList.length -1 )?'md:hover:rounded-b-md':'border-b'">

            <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                {{ index + 1 }}
            </div>

            <div class="px-3 py-3 md:w-3/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Product:</span>
                {{ order.orderable_title }}
                <span class="text-xs">({{ order.orderable_group_title }})</span>

            </div>

            <div class="px-3 py-3 md:w-3/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Count:</span>
                <span>{{ order.number }}</span>
            </div>

            <div class="px-3 py-3 md:w-2/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                <span>{{ order.amount }}</span>
            </div>

            <div class="px-3 py-3 md:w-1/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Price:</span>
                <span v-if="(order.price != null)">{{ format(order.price) }}</span>
                <span v-else>-</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'BasketProductsTable',
    props: {
        productsList: {}
    },
    methods: {
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
    }
}
</script>
