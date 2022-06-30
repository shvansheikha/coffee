<template>
    <div class="w-64 bg-white shadow px-4 h-screen">
        <div
            class="border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2 flex items-center">
            <a href="">
                <div class="flex items-center">
                    <img class="rounded-full w-8" src="img/default-avatar.jpg">
                    <span class="ml-2"> shvana</span>
                </div>
            </a>
        </div>

        <router-link
            to="/"
            :class="(currentRouteName === 'Home')?'text-blue-500 bg-gray-300' :'text-gray-800'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Home
            </div>
        </router-link>

        <router-link
            to="dashboard"
            :class="(currentRouteName === 'Dashboard')?'text-blue-500 bg-gray-300' :'text-gray-800'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Dashboard
            </div>
        </router-link>

        <router-link
            to="cards"
            :class="(currentRouteName === 'Cards')?'text-blue-500 bg-gray-300' :'text-gray-800'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Cards
            </div>
        </router-link>

        <router-link
            to="products"
            :class="(currentRouteName === 'Products')?'text-blue-500 bg-gray-300' :'text-gray-800 bg-grey-100'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Products
            </div>
        </router-link>


        <router-link
            to="games"
            :class="(currentRouteName === 'Games')?'text-blue-500 bg-nebula-300' :'text-gray-800 bg-grey-100'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Games
            </div>
        </router-link>


        <router-link
            to="groups"
            :class="(currentRouteName === 'Groups')?'text-blue-500 bg-nebula-300' :'text-gray-800 bg-grey-100'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                Groups
            </div>
        </router-link>

        <router-link
            to="about"
            :class="(currentRouteName === 'About')?'text-blue-500 bg-nebula-300' :'text-gray-800 bg-grey-100'">
            <div
                class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                About
            </div>
        </router-link>

        <div
            class="border border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
            <a v-on:click="exampleModalShowing = true">
                <div>Logout</div>
            </a>
        </div>

        <Modal :showing="exampleModalShowing" @close="exampleModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Logout</h2>
            <span class="mb-6 text-sm">Do you really want to logout?</span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="logout">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="exampleModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>


    </div>
</template>

<script>
import Modal from "./Modal";

export default {
    name: "SideBar",
    components: {Modal},
    data() {
        return {
            exampleModalShowing: false
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },
    methods: {
        logout() {
            axios.get('logout')
                .then(function (response) {
                    window.location.href = '/login'
                });
        },
    }
}
</script>

<style scoped>

</style>
