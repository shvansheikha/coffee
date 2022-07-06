<template>
    <div class="flex w-full font-mono">
        <div class="w-full px-4 py-4 md:px-10 md:pt-6 lg:px-40 lg:pt-10">

            <div class="w-full md:flex justify-between">
                @include('baskets.basket')
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
        }
    },
    created() {
        this.getGamesOrder();
        this.getProductOrder();
    },
    methods: {
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
