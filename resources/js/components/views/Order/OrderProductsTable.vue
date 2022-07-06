<template>
    <table v-if="productsList != null && productsList.length > 0"
           class="w-full text-sm text-left text-gray-500 cursor-pointer rounded shadow">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 text-xs py-3">
                Product
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Number
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Amount
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Price
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>

        <tr v-for="order in productsList" class="bg-white border-b hover:bg-gray-50">
            <th scope="row" class="px-6 text-xs py-3 font-medium text-gray-900 whitespace-nowrap">
                {{ order.orderable_title }}
                <span class="text-xs">({{ order.orderable_group_title }})</span>
            </th>
            <td class="px-2 text-xs py-3">
                {{ order.number }}
            </td>
            <td class="px-2 text-xs py-3">
                {{ order.amount }}
            </td>
            <td class="px-2 text-xs py-3">
                <span v-if="(order.price != null)">{{ order.price }}</span>
                <span v-else>-</span>
            </td>
            <td class="px-2 text-xs  py-4">
                <div @click="deleteOrder(order.id)" class="hover:text-blue-500 uppercase">Delete</div>
            </td>
        </tr>

        </tbody>
    </table>
</template>
<script>
export default {
    name: 'OrderProductsTable',
    props: {
        productsList: {}
    },
    methods: {
        deleteOrder(id) {
            axios.delete('orders/' + id)
                .then((res) => {
                    this.$emit('delete');
                }).catch((error) => {
                console.log(error.response.data.errors)
            });
        }
    }
}
</script>
