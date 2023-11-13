<template>
    <div
        v-if="gamesList != null && gamesList.length > 0"
        class="mt-4 w-full bg-white text-sm text-left cursor-pointer rounded-md shadow-md">
        <div
            class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

            <div class="text-center px-3 py-3 md:w-1/12">
                #
            </div>

            <div class="px-3 py-3 md:w-3/12">
                Game
            </div>

            <div class="px-3 py-3 md:w-2/12">
                Amount
            </div>

            <div class="px-3 py-3 md:w-2/12">
                Start
            </div>

            <div class="px-3 py-3 md:w-2/12">
                Stop
            </div>

            <div class="px-3 py-3 md:w-2/12">
                Price
            </div>
        </div>

        <div v-for="(order, index) in gamesList"
             class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
             :class="(index === gamesList.length -1 )?'md:hover:rounded-b-md':'border-b'">

            <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                {{ index + 1 }}
            </div>

            <div class="px-3 py-3 md:w-3/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Game:</span>
                {{ order.orderable_title }}
                <span class="text-xs">({{ order.orderable_group_title }})</span>

            </div>

            <div class="px-3 py-3 md:w-2/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                <span>{{ order.amount }}</span>
            </div>

            <div class="px-3 py-3 md:w-2/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Start:</span>
                <span>{{ order.started_at }}</span>
            </div>

            <div class="px-3 py-3 md:w-2/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Stop:</span>
                <span v-if="(order.stopped_at != null)">{{ order.stopped_at }}({{ order.diff }})</span>
                <span v-else>-</span>
            </div>

            <div class="px-3 py-3 md:w-2/12">
                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Price:</span>
                <span v-if="(order.price != null)">{{ format(order.price) }}</span>
                <span v-else>-</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'BasketGamesTable',
    props: {
        gamesList: {}
    },
    methods: {
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
    }
}
</script>
