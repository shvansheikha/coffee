<template>
    <div class="flex w-full font-mono">
        <div class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div class="w-full md:flex justify-between">
                <div class="w-full bg-white cursor-pointer shadow-md rounded p-4 md:flex justify-between hover:bg-gray-50">
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
