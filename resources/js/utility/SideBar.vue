<template>
    <div class="w-full h-full font-mono py-3 lg:py-8 flex flex-col items-center animated duration-500">
        <div class="h-full flex flex-col justify-between hidden w-full lg:block">
            <ul class="flex flex-col text-gray-700">
                <li>
                    <Link
                        href="/"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Home')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        Home
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <Link
                        href="/reports"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Reports')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        Reports
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <Link
                        href="/cards"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Cards')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                        Cards
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <Link
                        href="/products"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Products')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        Products
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <Link
                        href="/games"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Games')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        Games
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <Link
                        href="/groups"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Groups')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        Groups
                    </Link>
                </li>

                <li v-if="userIsLogin">
                    <div
                        v-on:click="settingModalShowing = true"
                        class="sidebar-item">
                        Setting
                    </div>
                </li>

                <li v-if="userIsLogin">
                    <div
                        v-on:click="logoutModalShowing = true"
                        class="sidebar-item">
                        Logout
                    </div>
                </li>

                <li v-if="!userIsLogin">
                    <Link
                        href="/login"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Login')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        Login
                    </Link>
                </li>

                <li v-if="!userIsLogin">
                    <Link
                        href="/register"
                        class="sidebar-item"
                        :class="(currentRouteName === 'Register')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                        Register
                    </Link>
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
                            <Link
                                href="/"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Home')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                Home
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <Link
                                href="/reports"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Reports')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                Reports
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <Link
                                href="/cards"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Cards')?'text-blue-700 bg-blue-50' :'text-gray-800'">
                                Cards
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <Link
                                href="/products"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Products')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                Products
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <Link
                                href="/games"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Games')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                Games
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <Link
                                href="/groups"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Groups')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                Groups
                            </Link>
                        </li>

                        <li v-if="userIsLogin">
                            <div
                                v-on:click="settingModalShowing = true"
                                class="sidebar-item">
                                Setting
                            </div>
                        </li>

                        <li v-if="userIsLogin">
                            <div
                                v-on:click="logoutModalShowing = true"
                                class="sidebar-item">
                                Logout
                            </div>
                        </li>

                        <li>
                            <Link
                                href="/login"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Login')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                Login
                            </Link>
                        </li>

                        <li>
                            <Link
                                href="/register"
                                class="sidebar-item"
                                :class="(currentRouteName === 'Register')?'text-blue-700 bg-blue-50' :'text-gray-800 bg-grey-100'">
                                Register
                            </Link>
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

import Modal from "./Modal.vue";
import axios from "axios";

export default {
    name: "SideBar",
    components: {Modal},
    props: {user: Object},
    data() {
        return {
            logoutModalShowing: false,
            settingModalShowing: false,
            menuIsOpen: false
        }
    },

    computed: {
        showSideBar() {
            const components = ['Login', 'Register'];
            return !components[this.$page.component];
        },
        userIsLogin() {
            return this.user != null;
        },
        currentRouteName() {
            return this.$page.component;
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
            this.$inertia.get('/logout', null, {
                preserveState: false,
                onSuccess: () => {
                    this.logoutModalShowing = false;
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
