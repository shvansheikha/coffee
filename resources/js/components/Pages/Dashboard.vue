<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-4 pt-6 pb-20 md:px-40 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">
            <div v-for="item in daysList" @click="goToBaskets(item.closed_at)">
                <div
                    class="w-full shadow-sm bg-white md:flex border rounded my-2 py-2 px-6 justify-between cursor-pointer hover:border-blue-500 hover:text-blue-500">
                    <div class="w-1/3">date: {{ item.date }}</div>
                    <div class="w-1/3">total: {{ item.total }}</div>
                    <div class="w-1/3">total_price:{{ format(item.total_price) }}</div>
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
