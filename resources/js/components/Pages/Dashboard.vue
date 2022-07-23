<template>
    <div class="flex w-full font-mono">

        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col overscroll-auto overflow-auto">

            <div
                class="w-full md:bg-white text-sm text-left text-gray-500 cursor-pointer md:rounded-md md:shadow-md">


                <div
                    class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                    <div class="text-center px-3 py-3 md:w-1/12">
                        #
                    </div>

                    <div class="px-3 py-3 md:w-4/12">
                        Date
                    </div>

                    <div class="px-3 py-3 md:w-3/12">
                        Baskets
                    </div>

                    <div class="px-3 py-3 md:w-3/12">
                        Total Price
                    </div>
                </div>

                <div v-for="(item, index) in daysList"
                     @click="goToBaskets(item.closed_at)"
                     class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium mb-4 md:mb-0 pb-2 md:pb-0 shadow-lg md:shadow-none bg-white md:bg-transparent rounded-md md:rounded-none"
                     :class="(index === daysList.length -1 )?'md:hover:rounded-b-md':'md:border-b'">

                    <div class="hidden md:block text-center px-3 py-3 md:w-1/12">
                        {{ index + 1 }}
                    </div>

                    <div class="px-3 py-3 md:w-4/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Date:</span>
                        <span>{{ item.date }}</span>
                    </div>

                    <div class="px-3 py-3 md:w-3/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Baskets:</span>
                        <span>{{ item.total }}</span>
                    </div>

                    <div class="px-3 py-3 md:w-3/12">
                        <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Total Price:</span>
                        <span>{{ format(item.total_price) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            user: null,
            daysList: null
        }
    },
    created() {
        this.getDaysList();
    },
    methods: {
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
        getDaysList() {
            axios.get('dashboard')
                .then((res) => {
                    this.daysList = res.data.data;
                })
        },
        goToBaskets(date) {
            this.$router.push({name: "Baskets", params: {date: date}});
        },
    }
}
</script>
