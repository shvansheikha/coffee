<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <form @submit.prevent="submit">
                <div class="md:flex items-center pb-4 mb-4 border-b">
                    <input type="text"
                           v-model="form.title"
                           class="mb-4 md:mb-0 w-full mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 hover:border-blue-600 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Group Title">

                    <select
                        v-model="form.type"
                        class="mb-4 md:mb-0 w-full form-select appearance-none mr-4 form-control block md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                        <option disabled value="">Please select</option>
                        <option value="Product">Product</option>
                        <option value="Game">Game</option>
                    </select>

                    <button type="submit"
                            class="text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                        Create
                    </button>
                </div>
            </form>

            <GroupsTable :groups-list="filteredList"/>
        </div>
    </div>
</template>
<script>

import GroupsTable from "../views/GroupsTable.vue";

export default {
    name: 'Groups',
    components: {GroupsTable},
    props: {groups: Array},
    data() {
        return {
            form: {
                title: '',
                type: '',
            }
        }
    },
    computed: {
        filteredList() {
            if (this.form.title) {
                return this.groups.filter((item) => {
                    return this.form.title.toLowerCase().split(' ').every(v => item.title.toLowerCase().includes(v))
                });
            } else {
                return this.groups;
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/groups', this.form,
                {
                    preserveState: false,
                    onSuccess: () => {
                        this.form.title = '';
                        this.form.type = '';
                    }
                })
        },
    }
}
</script>
