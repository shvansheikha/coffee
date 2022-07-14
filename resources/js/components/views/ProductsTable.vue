<template>
    <div>
        <div class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded-md shadow-lg">
            <div
                class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                <div class="text-center px-3 py-3 md:w-1/12 lg:w-1/12">
                    #
                </div>

                <div class="px-3 py-3 md:w-4/12 lg:w-4/12">
                    Title
                </div>

                <div class="px-3 py-3 md:w-3/12 lg:w-3/12">
                    Category
                </div>

                <div class="px-3 py-3 md:w-2/12 lg:w-2/12">
                    Amount
                </div>

                <div class="px-3 py-3 md:w-1/12 lg:w-1/12 items-center flex justify-center">
                    <span>Edit</span>
                </div>

                <div class="px-3 py-3 md:w-1/12 lg:w-1/12 items-center flex justify-center">
                    Delete
                </div>
            </div>

            <div v-for="(product, index) in productsList"
                 class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
                 :class="(index === productsList.length -1 )?'':'border-b'">

                <div class="hidden md:block text-center px-3 py-3 md:w-1/12 lg:w-1/12">
                    {{ index + 1 }}
                </div>

                <div class="px-3 py-3 md:w-4/12 lg:w-4/12 ">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Title:</span>
                    <span>{{ product.title }}</span>
                </div>

                <div class="px-3 py-3 md:w-3/12 lg:w-3/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Category:</span>
                    <span>{{ product.group }}</span>
                </div>

                <div class="px-3 py-3 md:w-2/12 lg:w-2/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                    <span>{{ product.amount }}</span>
                </div>

                <div class="md:w-2/12 flex m-2 md:m-0 rounded-md border md:border-none">
                    <div
                        @click="updateForm(product)"
                        class="w-1/2 px-3 py-2 rounded-l-md md:rounded-none bg-blue-500 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-gray-800 md:hover:text-blue-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>

                    <div
                        @click="confirmDelete(product)"
                        class="w-1/2 px-3 py-2 rounded-r-md md:rounded-none bg-gray-800 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-blue-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <Modal :showing="modalShowing" @close="modalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Delete Product</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.title }}</span>?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteProduct(deleteItem.id)">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="modalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

        <Modal :showing="updateModalShowing" @close="updateModalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Update Group</h2>

            <div class="mt-8 rounded-md md:flex w-80 items-center pb-4">
                <input type="text"
                       v-model="form.title"
                       class="mr-4 mt-4 md:mt-0 form-control block w-full md:w-2/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Title">

                <select
                    v-model="form.group_id"
                    class="form-select appearance-none mr-4 mt-4 md:mt-0 form-control block w-full md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option v-for="group in groupsList"
                            v-bind:value="group.id"
                            :selected="group.id === updateItem.group_id">
                        {{ group.title }}
                    </option>
                </select>

                <input type="text"
                       name="amount"
                       v-model="form.amount"
                       class="mr-4 mt-4 md:mt-0 form-control block w-full md:w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Amount">
            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="updateGame(updateItem.id)">
                    Update
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
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
    name: 'ProductsTable',
    components: {Modal},
    props: {
        productsList: {},
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
        deleteProduct(id) {
            this.deleteItem = null;
            this.modalShowing = false;
            axios.delete('products/' + id)
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
            await axios.put('products/' + id, this.form)
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
