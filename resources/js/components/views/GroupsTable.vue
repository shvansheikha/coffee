<template>
    <div>
        <table class="w-full text-sm text-left text-gray-500 cursor-pointer shadow rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
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
            <tr v-for="(group, index) in groupsList" class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                    {{ group.title }}
                </th>
                <td class="px-6 py-3">
                    {{ group.type }}
                </td>

                <td class="px-6 py-3">
                    <div @click="updateForm(group)" class="hover:text-blue-500 uppercase">edite</div>
                </td>

                <td class="px-6 py-3">
                    <div @click="confirmDelete(group)" class="hover:text-blue-500 uppercase">Delete</div>
                </td>
            </tr>
            </tbody>
        </table>
        <Modal :showing="deleteModalShowing" @close="deleteModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Delete Game</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.title }}</span> ?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteGroup(deleteItem.id)">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="deleteModalShowing = false">
                    Close
                </button>
            </div>
        </Modal>


        <Modal :showing="updateModalShowing" @close="updateModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Update Group</h2>

            <div class="mt-8 rounded flex items-center pb-4">
                <input type="text"
                       name="title"
                       v-model="form.title"
                       class="mr-4 form-control block w-64 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Enter Title">

                <select
                    name="type"
                    v-model="form.type"
                    class="form-select appearance-none mr-4 form-control block w-32 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option value="Product" :selected="form.type ==='Product'">Product</option>
                    <option value="Game" :selected="form.type ==='Game'">Game</option>
                </select>

            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="updateGroup(updateItem.id)">
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
    name: 'GroupsTable',
    components: {Modal},
    props: {
        groupsList: {}
    },
    data() {
        return {
            deleteItem: null,
            deleteModalShowing: false,
            updateItem: null,
            updateModalShowing: false,
            form: {
                id: null,
                title: null,
                type: null
            }
        }
    },
    methods: {
        confirmDelete(item) {
            this.deleteItem = item;
            this.deleteModalShowing = true;
        },
        deleteGroup(id) {
            this.deleteItem = null;
            this.deleteModalShowing = false;
            axios.delete('groups/' + id)
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
            this.form.type = item.type;
            this.updateModalShowing = true;
        },
        async updateGroup(id) {
            await axios.put('groups/' + id, this.form)
                .then((res) => {
                    this.$emit('update');
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
            this.form.id = null;
            this.form.title = null;
            this.form.type = null;
            this.updateItem = null;
            this.updateModalShowing = false;
        }
    }
}
</script>
