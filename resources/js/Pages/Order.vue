<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-10 md:px-10 lg:px-10 md:pt-10 h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div class="w-full md:flex justify-between items-start">
                <div class="md:w-2/3 shadow rounded-md py-1">
                    <OrderProductForm :basket="this.basket"/>

                    <OrderGameForm :basket="this.basket"/>
                </div>

                <div v-if="basket != null"
                     class="mt-4 md:mt-0 md:w-1/3 bg-white md:ml-5 shadow rounded-md p-4 flex flex-col">

                    <div class="text-sm">
                        <div><span>Card: </span><span> {{ basket.card_title }} </span></div>
                        <div><span>Product: </span><span> {{ format(basket.products_price) }} </span></div>
                        <div><span>Game: </span><span> {{ format(basket.games_price) }} </span></div>
                        <div class="text-blue-500 uppercase font-bold">
                            <span>Total: </span>
                            <span> {{ format(basket.products_price + basket.games_price) }} </span>
                        </div>
                    </div>

                    <input v-model="price"
                           placeholder="price..."
                           class="my-1 md:mb-0 form-control block w-full px-3 py-0.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">

                    <div class="flex mt-auto space-x-1">
                        <div
                            @click="printBasket"
                            class="text-center w-full mt-1 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-0.5">
                            Print
                        </div>
                        <div
                            @click="closeBasket"
                            class="text-center w-full mt-1 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-0.5">
                            Close
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <OrderProductsTable :products-list="products"/>
                </div>

                <div>
                    <OrderGamesTable :games-list="games"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import OrderGameForm from "../views/Order/OrderGameForm.vue";
import OrderGamesTable from "../views/Order/OrderGamesTable.vue";
import OrderProductsTable from "../views/Order/OrderProductsTable.vue";
import OrderProductForm from "../views/Order/OrderProductForm.vue";

export default {
    name: 'Order',
    components: {OrderProductForm, OrderProductsTable, OrderGamesTable, OrderGameForm},
    props: {
        basket: Object,
        games: Array,
        products: Array,
    },
    data() {
        return {
            price: this.basket.products_price + this.basket.games_price
        }
    },
    methods: {
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
        printBasket() {
            let routeData = this.$router.resolve({name: 'Print', params: {basket: this.basket}});
            window.open(routeData.href, '_blank');
        },
        closeBasket() {
            this.$inertia.put('/baskets/' + this.basket.id, {closed: true, price: this.price}, {
                preserveState: false
            });
        },
    }
}
</script>
