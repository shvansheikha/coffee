<template>

    <div class="lg:flex h-screen">

        <div
            v-if="showMenu"
            class="lg:h-screen w-full px-4 lg:w-60">
            <SideBar></SideBar>
        </div>

        <div class="flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto bg-gray-back">
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
                this.currentRouteName === 'Register' ||
                this.currentRouteName === 'forgot-password' ||
                this.currentRouteName === 'reset-password' ||
                this.currentRouteName === 'Print' ||
                this.currentRouteName === '404');
        }
    },
}
</script>

<style scoped>

</style>
