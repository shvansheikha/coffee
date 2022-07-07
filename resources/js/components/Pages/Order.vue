<template>
    <div class="flex w-full font-mono">
        <div class="w-full px-4 py-4 md:px-10 md:pt-6 lg:px-40 lg:pt-10">

            <div class="w-full md:flex justify-between">
                <div class="w-2/3 bg-white shadow rounded">
                    <OrderProductForm
                        :basket="this.basket"
                        @update-product="this.getProductOrder(); this.getBasket()"/>

                    <OrderGameForm
                        :basket="this.basket"
                        @update-game="this.getGamesOrder(); this.getBasket()"/>
                </div>
                <div class="w-1/3 bg-white ml-5 shadow rounded p-4 flex flex-col">
                    <div>
                        <div><span>Card: </span><span> {{ basketObject.card_title }} </span></div>
                        <div><span>Product: </span><span> {{ basketObject.products_price }} </span></div>
                        <div><span>Game: </span><span> {{ basketObject.games_price }} </span></div>
                        <div class="text-blue-500 uppercase font-bold">
                            <span>Total: </span><span> {{
                                basketObject.products_price + basketObject.games_price
                            }} </span></div>
                    </div>

                    <div class="mt-auto mt-8">
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
                        @stop-game="this.getGamesOrder(); this.getBasket()"
                    />
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
