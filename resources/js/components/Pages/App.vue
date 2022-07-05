<template>

    <div class="md:flex h-screen">

        <div
            v-if="showMenu"
            class="md:h-screen md:w-1/6 w-full px-4 bg-grey-100 w-48 flex-shrink-0 border-r border-gray-200 md:flex-col">
            <SideBar></SideBar>
        </div>

        <div class="flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto bg-gray-50">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>

import SideBar from "../utility/SideBar";

export default {
    name: "App",
    components: {SideBar},
    computed: {
        currentRouteName() {
            return this.$route.name;
        },
        showMenu() {
            return !(
                this.currentRouteName === 'Login' ||
                this.currentRouteName === 'register' ||
                this.currentRouteName === 'forgot-password' ||
                this.currentRouteName === 'reset-password' ||
                this.currentRouteName === '404');
        }
    },
}
</script>

<style scoped>

</style>
