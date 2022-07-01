<template>
    <div>
        <table class="w-full text-sm text-left text-gray-500 cursor-pointer shadow rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Edit</span>
                </th>

                <th scope="col" class="px-6 py-3">
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>


            <tr v-for="(game, index) in gamesList" class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ (index) + 1 }}
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ game.title }}
                </th>
                <td class="px-6 py-4">
                    {{ game.group }}
                </td>
                <td class="px-6 py-4">
                    {{ game.amount }}
                </td>
                <td class="px-6 py-3">
                    <div @click="updateForm(game)" class="hover:text-blue-500 uppercase">
                        edite
                    </div>
                </td>

                <td class="px-6 py-4">
                    <div @click="confirmDelete(game)" class="hover:text-blue-500">
                        Delete
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <Modal :showing="modalShowing" @close="modalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Delete Game</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.title }}</span>?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteGame(deleteItem.id)">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="modalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

        <Modal :showing="updateModalShowing" @close="updateModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Update Group</h2>

            <div class="mt-8 rounded flex items-center pb-4">
                <input type="text"
                       v-model="form.title"
                       class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Title">

                <select
                    v-model="form.group_id"
                    class="form-select appearance-none mr-4 form-control block w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option v-for="group in groupsList"
                            v-bind:value="group.id"
                            :selected="group.id === updateItem.group_id">
                        {{ group.title }}
                    </option>
                </select>

                <input type="text"
                       name="amount"
                       v-model="form.amount"
                       class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Amount">
            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="updateGame(updateItem.id)">
                    Update
                </button>

                <button
                    class="px-4 py-1 rounded border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="updateModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>
    </div>
</template>
<script>
import Modal from "../utility/Modal";

export default {
    name: 'GamesTable',
    components: {Modal},
    props: {
        gamesList: {},
        groupsList: {}
    },
    data() {
        return {
            deleteItem: null,
            modalShowing: false,
            updateItem: null,
            updateModalShowing: false,
            form: {
                id: null,
                title: null,
                amount: null,
                group_id: null
            }
        }
    },
    methods: {
        confirmDelete(item) {
            this.deleteItem = item;
            this.modalShowing = true;
        },
        deleteGame(id) {
            this.deleteItem = null;
            this.modalShowing = false;
            axios.delete('games/' + id)
                .then((res) => {
                    this.$emit('delete');
                }).catch((error) => {
                console.log(error.response.data.errors)
            });
        },
        updateForm(item) {
            this.updateItem = item;
            this.form.id = item.id;
            this.form.title = item.title;
            this.form.amount = item.amount;
            this.form.group_id = item.group_id;
            this.updateModalShowing = true;
        },
        async updateGame(id) {
            await axios.put('games/' + id, this.form)
                .then((res) => {
                    this.$emit('update');
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
            this.form.id = null;
            this.form.title = null;
            this.form.amount = null;
            this.form.group_id = null;
            this.updateItem = null;
            this.updateModalShowing = false;
        }
    }
}
</script>
