<template>
    <div class="flex w-full font-mono">
        <div class="w-full px-4 py-4 md:px-10 md:pt-6 lg:px-40 lg:pt-10">

            <div class="w-full md:flex justify-between">
                <div class="w-2/3">
                    <OrderProductForm :basket="this.basket" @update-product="this.getProductOrder"/>

                    <OrderGameForm :basket="this.basket" @update-game="this.getGamesOrder"/>
                </div>
                <div class="w-1/3 ">
                    Basket
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <OrderProductsTable :products-list="productsList" @delete="this.getProductOrder"/>
                </div>
                <div class="">
                    <OrderGamesTable
                        :games-list="orderGamesList"
                        @delete="this.getGamesOrder"
                        @stop-game="this.getGamesOrder"
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
