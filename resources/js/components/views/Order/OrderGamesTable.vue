<template>
    <div>
        <div v-if="gamesList != null && gamesList.length > 0" class="mt-4">
            <div class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded-md shadow-md">
                <div
                    class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                    <div class="text-center px-3 py-3 md:w-1/12">
                        #
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        Game
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        Amount
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        Started At
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        Stopped At
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        Price
                    </div>

                    <div class="px-3 py-3 md:w-1/12 items-center flex justify-center">
                        Stop
                    </div>

                    <div class="px-3 py-3 md:w-1/12 items-center flex justify-center">
                        Delete
                    </div>
                </div>

                <div v-for="(game, index) in gamesList"
                     class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium pb-2 md:pb-0"
                     :class="(index === gamesList.length -1 )?'md:hover:rounded-b-md':'border-b'">

                    <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                        {{ index + 1 }}
                    </div>

                    <div class="px-3 py-3 md:w-2/12 ">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Title:</span>
                        <span>{{ game.orderable_title }}</span>
                        <span class="text-xs">
                    ({{ game.orderable_group_title }})
                    </span>

                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                        <span>{{ game.amount }}</span>
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Start:</span>
                        <span>{{ game.started_at }}</span>
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Stopped AT:</span>
                        <span v-if="(game.stopped_at != null)">{{ game.stopped_at }}({{ game.diff }})</span>
                        <span class="text-blue-500" v-else-if="game.timer">{{ game.timer }}</span>
                        <span v-else>-</span>
                    </div>

                    <div class="px-3 py-3 md:w-2/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Price:</span>
                        <span v-if="(game.price != null)">{{ format(game.price) }}</span>
                        <span v-else>-</span>
                    </div>

                    <div class="md:w-2/12 flex m-2 md:m-0 rounded-md border md:border-none">
                        <div
                            @click="stopGame(game)"
                            class="w-1/2 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"/>
                            </svg>
                        </div>

                        <div
                            @click="confirmDelete(game)"
                            class="w-1/2 px-3 py-2 rounded-r-md md:rounded-none bg-gray-800 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-blue-500 uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <Modal :showing="modalShowing" @close="modalShowing = false">
                <h2 class="text-lg font-bold text-gray-900">Delete Order</h2>
                <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.orderable_title }}</span>?
            </span>

                <div class="flex mt-8">
                    <button
                        class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                        @click="deleteOrder(deleteItem.id)">
                        Yes
                    </button>

                    <button
                        class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                        @click="modalShowing = false">
                        Close
                    </button>
                </div>
            </Modal>

        </div>
    </div>
</template>
<script>
import Modal from "../../utility/Modal";

export default {
    name: 'OrderGamesTable',
    components: {Modal},
    props: {
        gamesList: {}
    },
    created() {
        this.startTimer()
    },
    mounted() {
        setInterval(() => {
            this.startTimer()
        }, 1000);
    },
    data() {
        return {
            deleteItem: null,
            modalShowing: false,
        }
    },
    methods: {
        startTimer: function () {
            this.gamesList.forEach(function (game) {
                if (game.stopped_at === null) {
                    const timeNow = new Date().getTime();
                    const created_at = new Date(game.created_at);
                    const timeDifference = timeNow - created_at;
                    const millisecondsInOneSecond = 1000;
                    const millisecondsInOneMinute = millisecondsInOneSecond * 60;
                    const millisecondsInOneHour = millisecondsInOneMinute * 60;
                    const millisecondsInOneDay = millisecondsInOneHour * 24;
                    const differenceInDays = timeDifference / millisecondsInOneDay;
                    const remainderDifferenceInHours = (timeDifference % millisecondsInOneDay) / millisecondsInOneHour;
                    const remainderDifferenceInMinutes = (timeDifference % millisecondsInOneHour) / millisecondsInOneMinute;
                    const remainderDifferenceInSeconds = (timeDifference % millisecondsInOneMinute) / millisecondsInOneSecond;
                    const remainingDays = Math.floor(differenceInDays);
                    const remainingHours = Math.floor(remainderDifferenceInHours);
                    const remainingMinutes = Math.floor(remainderDifferenceInMinutes);
                    const remainingSeconds = Math.floor(remainderDifferenceInSeconds);
                    game.timer = "";
                    if (remainingDays > 0) {
                        game.timer += remainingDays + ":";
                    }

                    if (remainingHours > 0) {
                        game.timer += remainingHours + ":"
                    }

                    game.timer += remainingMinutes + ":" + remainingSeconds
                }
            });
        },
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
        confirmDelete(item) {
            this.deleteItem = item;
            this.modalShowing = true;
        },
        deleteOrder(id) {
            this.deleteItem = null;
            this.modalShowing = false;
            axios.delete('orders/' + id)
                .then((res) => {
                    this.$emit('delete');
                }).catch((error) => {
                console.log(error.response.data.errors)
            });
        },
        stopGame(game) {
            if (game.stopped_at === null) {
                axios.get('orders/' + game.id)
                    .then((res) => {
                        this.$emit('stopGame');
                    }).catch((error) => {
                    console.log(error.response.data.errors)
                });
            }
        }
    }
}
</script>

