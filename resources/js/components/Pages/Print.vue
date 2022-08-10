<template>
    <div class="flex w-full font-mono bg-white">
        <div
            class="w-full flex-grow h-screen flex flex-col overscroll-auto overflow-auto">

            <div class="w-full lg:w-1/3 text-gray-900 text-center">

                <div class="py-2 px-2">
                    <div class="font-bold text-2xl">{{user.coffee_title}}</div>
                    <div class="mt-3 text-xs text-left">
                        <span>{{ moment(new Date()).format("jYYYY/jM/jD HH:mm") }}</span>
                    </div>
                </div>
                <div class="py-2 my-1">

                    <div class="text-2xs">
                        <div v-if="productsList != null && productsList.length > 0"
                             class="w-full bg-white text-left text-gray-900 cursor-pointer">
                            <div
                                class="text-gray-900 uppercase flex justify-between font-medium">

                                <div class="px-1 py-1 w-4/12">
                                    Title
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    Count
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    Amount
                                </div>

                                <div class="px-1 py-1 w-3/12">
                                    Price
                                </div>
                            </div>

                            <div v-for="(order, index) in productsList"
                                 class="w-full flex justify-between font-medium">

                                <div class="px-1 py-1 w-4/12">
                                    <span>{{ order.orderable_title }}</span>
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    <span>{{ order.number }}</span>
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    <span>{{ format(order.amount) }}</span>
                                </div>

                                <div class="px-1 py-1 w-3/12">
                                    <span v-if="(order.price != null)">{{ format(order.price) }}</span>
                                    <span v-else>-</span>
                                </div>
                            </div>
                        </div>

                        <div v-if="orderGamesList != null && orderGamesList.length > 0"
                             class="w-full bg-white text-left text-gray-900 cursor-pointer mt-4">
                            <div
                                class="text-gray-900 uppercase flex justify-between font-medium">

                                <div class="px-1 py-1 w-4/12">
                                    Game
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    Min
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    Amount
                                </div>

                                <div class="px-1 py-1 w-3/12">
                                    Price
                                </div>
                            </div>

                            <div v-for="(game, index) in orderGamesList"
                                 class="w-full flex justify-between font-medium">

                                <div class="px-1 py-1 w-4/12">
                                    <span>{{ game.orderable_title }}</span>
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    <span v-if="(game.stopped_at != null)">{{ game.diff }}</span>
                                    <span class="text-blue-500" v-else-if="game.timer">{{ game.timer }}</span>
                                    <span v-else>-</span>
                                </div>

                                <div class="px-1 py-1 w-2/12">
                                    <span>{{ game.amount }}</span>
                                </div>

                                <div class="px-1 py-1 w-3/12">
                                    <span v-if="(game.price != null)">{{ format(game.price) }}</span>
                                    <span v-else>-</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="w-full py-2 text-lg">
                    <div v-if="basketObject != null">
                        <div><span>Product: </span><span> {{ format(basketObject.products_price) }} </span></div>
                        <div><span>Game: </span><span> {{ format(basketObject.games_price) }} </span></div>
                        <div>
                            <span>Total: </span>
                            <span> {{ format(basketObject.products_price + basketObject.games_price) }} </span>
                        </div>
                    </div>
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
import moment from 'moment-jalaali'
import axios from "axios";


export default {
    components: {OrderProductForm, OrderProductsTable, OrderGamesTable, OrderGameForm},
    props: ['basket'],
    data() {
        return {
            orderGamesList: null,
            productsList: null,
            basketObject: null,
            dateTime: null,
            user: null,
        }
    },
    created() {
        this.date();
        this.getUser();
        this.getGamesOrder();
        this.getProductOrder();
        this.getBasket();
        this.moment = moment;
    },
    methods: {
        date() {
            const today = new Date();
            const date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            this.dateTime = date + ' ' + time;
        },
        getUser() {
            axios.get('user')
                .then((res) => {
                    this.user = res.data;
                }).catch(() => {
            });
        },
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
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
