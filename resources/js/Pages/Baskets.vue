<template>

    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div>
                <div class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded-md shadow-lg">
                    <div
                        class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                        <div class="text-center px-3 py-3 md:w-1/12">
                            #
                        </div>

                        <div class="px-3 py-3 md:w-3/12">
                            Card
                        </div>

                        <div class="px-3 py-3 md:w-3/12">
                            Total Price
                        </div>

                        <div class="px-3 py-3 md:w-2/12">
                            Start
                        </div>

                        <div class="px-3 py-3 md:w-1/12">
                            Stop
                        </div>

                        <div class="px-3 py-3 md:w-2/12 items-center flex justify-center">
                            Orders
                        </div>
                    </div>

                    <Link v-for="(basket, index) in baskets" :href="'/baskets/'+basket.id">
                        <div class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
                             :class="(index === baskets.length -1 )?'md:hover:rounded-b-md':'border-b'">

                            <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                                {{ index + 1 }}
                            </div>

                            <div class="px-3 py-3 md:w-3/12">
                                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Card:</span>
                                <span>{{ basket.card_title }}</span>
                            </div>

                            <div class="px-3 py-3 md:w-3/12">
                                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Total Price:</span>
                                <span>{{ basket.total_price }}</span>
                            </div>

                            <div class="px-3 py-3 md:w-2/12">
                                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Start:</span>
                                <span>{{ basket.created_at }}</span>
                            </div>

                            <div class="px-3 py-3 md:w-1/12">
                                <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Stop:</span>
                                <span>{{ basket.closed_at }}</span>
                            </div>

                            <div class="px-3 py-3 md:px-0 md:py-0 md:w-2/12">

                                <div
                                    class="w-full px-3 py-2 rounded-md md:rounded-none bg-gray-800 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-blue-500 uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Baskets',
    props: {baskets: Array}
}
</script>
