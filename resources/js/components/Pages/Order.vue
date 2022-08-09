<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div class="w-full md:flex justify-between">
                <div class="md:w-2/3 bg-white shadow rounded-md">
                    <OrderProductForm
                        :basket="this.basket"
                        @update-product="this.getProductOrder(); this.getBasket()"/>

                    <OrderGameForm
                        :basket="this.basket"
                        @update-game="this.getGamesOrder(); this.getBasket()"/>
                </div>
                <div v-if="basketObject != null"
                     class="mt-4 md:mt-0 md:w-1/3 bg-white md:ml-5 shadow rounded-md p-4 flex flex-col">
                    <div>
                        <div><span>Card: </span><span> {{ basketObject.card_title }} </span></div>
                        <div><span>Product: </span><span> {{ format(basketObject.products_price) }} </span></div>
                        <div><span>Game: </span><span> {{ format(basketObject.games_price) }} </span></div>
                        <div class="text-blue-500 uppercase font-bold">
                            <span>Total: </span>
                            <span> {{ format(basketObject.products_price + basketObject.games_price) }} </span>
                        </div>
                    </div>

                    <div class="mt-auto mt-8">
                        <div
                            @click="printBasket"
                            class="text-center w-full mt-2 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                            Print
                        </div>
                        <div
                            @click="closeBasket"
                            class="text-center w-full mt-2 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                            Close
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <OrderProductsTable
                        :products-list="productsList"
                        @delete="this.getProductOrder(); this.getBasket()"/>
                </div>

                <div class="">
                    <OrderGamesTable
                        :games-list="orderGamesList"
                        @delete="this.getGamesOrder(); this.getBasket()"
                        @stop-game="this.getGamesOrder(); this.getBasket()"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import OrderGameForm from "../views/Order/OrderGameForm";
import OrderGamesTable from "../views/Order/OrderGamesTable";
import OrderProductsTable from "../views/Order/OrderProductsTable";
import OrderProductForm from "../views/Order/OrderProductForm";

export default {
    components: {OrderProductForm, OrderProductsTable, OrderGamesTable, OrderGameForm},
    props: ['basket'],
    data() {
        return {
            orderGamesList: null,
            productsList: null,
            basketObject: null
        }
    },
    created() {
        this.getGamesOrder();
        this.getProductOrder();
        this.getBasket();
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
            axios.put('baskets/' + this.basket, {closed: true})
                .then((res) => {
                    this.$router.push({name: "Cards"});
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
        },
        getBasket() {
            axios.get('baskets/' + this.basket)
                .then((res) => {
                    this.basketObject = res.data.data;
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
        },
        getGamesOrder() {
            axios.get('orders', {params: {type: 'game', basket: this.basket}})
                .then((res) => {
                    this.orderGamesList = res.data.data;
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
        },
        getProductOrder() {
            axios.get('orders', {params: {type: 'product', basket: this.basket}})
                .then((res) => {
                    this.productsList = res.data.data;
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
        },
    }
}
</script>
