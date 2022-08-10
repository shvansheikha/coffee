<template>
    <div class="w-full h-full font-mono py-3 lg:py-8 flex flex-col items-center animated duration-500">
        <div class="h-full flex flex-col justify-between hidden w-full lg:block">
            <ul class="flex flex-col text-gray-700">
                <li>
                    <router-link
                        to="/"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Home')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        <div>Home</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <router-link
                        to="/dashboard"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Dashboard')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        <div>Dashboard</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <router-link
                        to="/cards"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Cards')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        <div>Cards</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <router-link
                        to="/products"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Products')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        <div>Products</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <router-link
                        to="/games"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Games')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        <div>Games</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <router-link
                        to="/groups"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Groups')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        <div>Groups</div>
                    </router-link>
                </li>

                <li v-if="userIsLogin">
                    <div
                        v-on:click="settingModalShowing = true"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform">
                        <div>Setting</div>
                    </div>
                </li>

                <li v-if="userIsLogin">
                    <div
                        v-on:click="logoutModalShowing = true"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform">
                        <div>Logout</div>
                    </div>
                </li>

                <li v-if="!userIsLogin">
                    <router-link
                        to="/login"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Login')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        <div>Login</div>
                    </router-link>
                </li>

                <li v-if="!userIsLogin">
                    <router-link
                        to="/register"
                        class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                        :class="(currentRouteName === 'Register')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        <div>Register</div>
                    </router-link>
                </li>

            </ul>
        </div>

        <div class="block lg:hidden w-full flex justify-end">
            <button
                class="outline-none focus:outline-none px-4 py-2"
                @click="menuIsOpen = !menuIsOpen">
                <svg class=" w-6 h-6 text-gray-500 hover:text-nebula-500"
                     fill="none"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

        </div>

        <div
            v-show="menuIsOpen"
            class="block lg:hidden w-full">

            <div
                class="flex flex-col justify-between px-4 pb-4">
                <nav>
                    <ul class="flex flex-col text-gray-700">
                        <li>
                            <router-link
                                to="/"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Home')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                <div>Home</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <router-link
                                to="/dashboard"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Dashboard')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                <div>Dashboard</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <router-link
                                to="/cards"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Cards')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                <div>Cards</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <router-link
                                to="/products"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Products')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                <div>Products</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <router-link
                                to="/games"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Games')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                <div>Games</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <router-link
                                to="/groups"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Groups')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                <div>Groups</div>
                            </router-link>
                        </li>

                        <li v-if="userIsLogin">
                            <div
                                v-on:click="settingModalShowing = true"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform">
                                <div>Setting</div>
                            </div>
                        </li>

                        <li v-if="userIsLogin">
                            <div
                                v-on:click="logoutModalShowing = true"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform">
                                <div>Logout</div>
                            </div>
                        </li>

                        <li v-if="!userIsLogin">
                            <router-link
                                to="/login"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Login')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                <div>Login</div>
                            </router-link>
                        </li>

                        <li v-if="!userIsLogin">
                            <router-link
                                to="/register"
                                class="py-1.5 px-4 my-1 block hover:text-blue-700 rounded-lg cursor-pointer hover:border-gray-300 hover:bg-blue-50 transition duration-300
                 ease-in-out transform"
                                :class="(currentRouteName === 'Register')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                <div>Register</div>
                            </router-link>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>

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

        <Modal :showing="settingModalShowing" @close="settingModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Setting</h2>
            <span class="mb-6 text-sm">Do you really want to logout?</span>

            <input
                class="mt-2 w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                placeholder="Print Title"
                type="text"
                v-model="user.coffee_title">

            <div class="flex mt-8">
                <button
                    class="px-4 py-1.5 rounded border hover:border-blue-500 hover:text-blue-700"
                    @click="saveSetting">
                    Save
                </button>

                <button
                    class="px-4 py-1.5 rounded border ml-4 hover:border-blue-500 hover:text-blue-700"
                    @click="settingModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

    </div>
</template>

<script>
import Modal from "./Modal";
import axios from "axios";

export default {
    name: "SideBar",
    components: {Modal},
    data() {
        return {
            logoutModalShowing: false,
            settingModalShowing: false,
            userIsLogin: false,
            menuIsOpen: false,
            user: null
        }
    },
    created() {
        this.authenticated();
    },

    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },

    watch: {
        $route(to, from) {
            this.menuIsOpen = false;
            this.authenticated()
        }
    },
    methods: {
        saveSetting() {
            axios.put('/user', this.user)
                .then((res) => {
                    this.user = res.data.data;
                })
        },

        logout() {
            axios.get('logout')
                .then(function (response) {
                    window.location.href = '/login'
                });
        },
        authenticated() {
            axios.get('user')
                .then((response) => {
                    this.userIsLogin = true;
                    this.user = response.data;
                }).catch(() => {
                this.userIsLogin = false;
            });
        }
    }
}
</script>

<style scoped>

</style>
