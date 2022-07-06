<template>
    <div class="flex w-full font-mono">
        <div class="w-full px-4 py-4 md:px-10 md:pt-6 lg:px-40 lg:pt-10">

            <div class="w-full md:flex justify-between">
                <div class="w-full bg-white cursor-pointer shadow rounded p-4 md:flex justify-between">
                    <div><span>Card: </span><span> {{ basketObject.card_title }} </span></div>
                    <div><span>Product: </span><span> {{ basketObject.products_price }} </span></div>
                    <div><span>Game: </span><span> {{ basketObject.games_price }} </span></div>
                    <div class="text-blue-500 uppercase font-bold">
                        <span>Total: </span><span> {{ basketObject.total_price }} </span></div>
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <BasketProductsTable :products-list="productsList"/>
                </div>
                <div class="">
                    <BasketGamesTable :games-list="gamesList"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import BasketGamesTable from "../views/Basket/BasketGamesTable";
import BasketProductsTable from "../views/Basket/BaskerProductsTable";

export default {
    components: {BasketProductsTable, BasketGamesTable},
    props: ['basket'],
    data() {
        return {
            gamesList: null,
            productsList: null,
            basketObject: null,
        }
    },
    created() {
        this.getGamesOrder();
        this.getProductOrder();
        this.getBasket();
    },
    methods: {
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
                    this.gamesList = res.data.data;
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
        }
    }
}
</script>
