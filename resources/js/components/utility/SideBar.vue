<template>
    <div>
        <div
            class="border-transparent hover:border-blue-500 transition-none cursor-pointer hover:text-blue-700 rounded px-4 py-1.5 mt-2 flex items-center">
            <a href="">
                <div class="flex items-center">
                    <img class="rounded-full w-8" src="img/default-avatar.jpg">
                    <span class="ml-2">shvana</span>
                </div>
            </a>
        </div>

        <ul class="flex flex-col text-gray-700 mt-6">

            <li>
                <router-link
                    to="/"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Home')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                    <div>Home</div>
                </router-link>
            </li>

            <li>
                <router-link
                    to="/dashboard"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Dashboard')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                    <div>Dashboard</div>
                </router-link>
            </li>

            <li>
                <router-link
                    to="/cards"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Cards')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                    <div>Cards</div>
                </router-link>
            </li>

            <li>
                <router-link
                    to="/products"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Products')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                    <div>Products</div>
                </router-link>
            </li>


            <li>
                <router-link
                    to="/games"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Games')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                    <div>Games</div>
                </router-link>
            </li>


            <li>
                <router-link
                    to="/groups"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'Groups')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                    <div>Groups</div>
                </router-link>
            </li>

            <li>
                <router-link
                    to="/about"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                    :class="(currentRouteName === 'About')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                    <div>About</div>
                </router-link>
            </li>

            <li>
                <div
                    v-on:click="logoutModalShowing = true"
                    class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform">
                    <div>Logout</div>
                </div>
            </li>

        </ul>

        <Modal :showing="logoutModalShowing" @close="logoutModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Logout</h2>
            <span class="mb-6 text-sm">Do you really want to logout?</span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1.5 rounded border hover:border-blue-500 hover:text-blue-700"
                    @click="logout">
                    Yes
                </button>

                <button
                    class="px-4 py-1.5 rounded border ml-4 hover:border-blue-500 hover:text-blue-700"
                    @click="logoutModalShowing = false">
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
            logoutModalShowing: false
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
