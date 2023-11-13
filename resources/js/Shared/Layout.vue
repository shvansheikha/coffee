<template>

    <Head>
        <title>TITLE</title>
    </Head>
    <div class="lg:flex h-screen">

        <div
            v-if="showMenu"
            class="lg:h-screen w-full px-4 lg:w-60">
            <SideBar :user="user"></SideBar>
        </div>

        <div class="text-gray-700 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto bg-gray-back">
            <slot></slot>
        </div>
    </div>
</template>

<script>

import SideBar from "../utility/SideBar.vue";

export default {
    name: "Layout",
    components: {SideBar},
    props: {user: Object},
    computed: {
        showMenu() {
            const components = ['Login', 'Register'];
            return !components[this.$page.component];
        }
    }
}
</script>

