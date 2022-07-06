<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-4 pt-6 pb-20 md:px-40 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">
            <table class="w-full text-sm text-left text-gray-500 cursor-pointer shadow rounded">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Card
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stop
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Orders
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(basket, index) in basketsList"
                    @click="goToBasketDetail(basket)"
                    class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ index + 1 }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ basket.card_title }}
                    </th>

                    <td class="px-6 py-4">
                        {{ basket.total_price }}
                    </td>

                    <td class="px-6 py-4">
                        {{ basket.created_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ basket.closed_at }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="hover:text-blue-500">Orders</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>

export default {
    props: ['date'],
    data() {
        return {
            basketsList: null,
        }
    },
    created() {
        this.getBasketList();
    },
    methods: {
        getBasketList() {
            axios.get('baskets', {params: {date: this.date}})
                .then((res) => {
                    this.basketsList = res.data.data;
                })
        },
        goToBasketDetail(basket) {
            this.$router.push({name: "BasketDetail", params: {basket: basket.id}});
        },
    }
}
</script>
