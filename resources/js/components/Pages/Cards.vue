<template>
    <div class="flex w-full font-mono">

        <SideBar></SideBar>

        <div class="w-full px-4 pt-6 md:px-40 md:pt-20">
            <table class="w-full text-sm text-left text-gray-500 cursor-pointer shadow rounded">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Order
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Edite
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="card in cardsList" class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                        {{ card.title }}
                    </th>
                    <td class="px-6 py-3">
                        <a href="/"
                           class="font-medium text-blue-600 hover:underline">
                            Order
                        </a>
                    </td>

                    <td class="px-6 py-3">
                        <a href="/" class="hover:text-blue-500 uppercase">
                            <div>edite</div>
                        </a>
                    </td>

                    <td class="px-6 py-3">
                        <a href="/"
                           class="hover:text-blue-500 uppercase">
                            <div>Delete</div>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>


import SideBar from "../utility/SideBar";

export default {
    components: {SideBar},
    data() {
        return {
            cardsList: null
        }
    },
    created() {
        this.getCardsList();
    },
    methods: {
        logout() {
            axios.post('logout').then(() => {
                this.$router.push({name: "Home"})
            })
        },
        getCardsList() {
            axios.get('cards')
                .then((res) => {
                    this.cardsList = res.data.data;
                })
        }
    }
}
</script>
