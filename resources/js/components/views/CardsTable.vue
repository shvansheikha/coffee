<template>
    <div>
        <table class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded shadow">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Order
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

            <tr v-for="(card, index) in cardsList"
                class="hover:bg-gray-50"
                :class="(index === cardsList.length -1 )?'':'border-b'">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                    {{ index + 1 }}
                </th>
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                    {{ card.title }}
                </th>
                <td class="px-6 py-3">
                    <div @click="goToOrder(card.basket.id)" class="font-medium text-blue-600 hover:underline">
                        Order
                    </div>
                </td>

                <td class="px-6 py-3">
                    <div @click="updateForm(card)" class="hover:text-blue-500 uppercase">
                        edite
                    </div>
                </td>

                <td class="px-6 py-3">
                    <div class="hover:text-blue-500 uppercase" @click="confirmDelete(card)">Delete</div>
                </td>
            </tr>
            </tbody>
        </table>

        <Modal :showing="modalShowing" @close="modalShowing = false">
            <h2 class="text-lg font-bold text-gray-900">Delete Card</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.title }}</span> ?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteCard(deleteItem.id)">
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
            <h2 class="text-lg font-bold text-gray-900">Update Card</h2>

            <div class="mt-8 rounded flex items-center pb-4">
                <input type="text"
                       name="title"
                       v-model="form.title"
                       class="mr-4 form-control block w-64 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Enter Title">
            </div>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded border hover:border-blue-500 hover:text-blue-500"
                    @click="updateCard(updateItem.id)">
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
    name: 'CardTable',
    components: {Modal},
    props: {
        cardsList: {}
    },
    data() {
        return {
            deleteItem: null,
            modalShowing: false,
            updateItem: null,
            updateModalShowing: false,
            form: {
                id: null,
                title: null
            }
        }
    },
    methods: {
        confirmDelete(item) {
            this.deleteItem = item;
            this.modalShowing = true;
        },
        deleteCard(id) {
            this.deleteItem = null;
            this.modalShowing = false;
            axios.delete('cards/' + id)
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
            this.updateModalShowing = true;
        },
        async updateCard(id) {
            await axios.put('cards/' + id, this.form)
                .then((res) => {
                    this.$emit('update');
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                });
            this.form.id = null;
            this.form.title = null;
            this.updateItem = null;
            this.updateModalShowing = false;
        },
        goToOrder(basketID) {
            this.$router.push({name: "Order", params: {basket: basketID}});
        },
    }
}
</script>
