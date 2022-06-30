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

            <tr v-for="(card, index) in cardsList" class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                    {{ index + 1 }}
                </th>
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                    {{ card.title }}
                </th>
                <td class="px-6 py-3">
                    <a href="/public"
                       class="font-medium text-blue-600 hover:underline">
                        Order
                    </a>
                </td>

                <td class="px-6 py-3">
                    <a href="/" class="hover:text-blue-500 uppercase">
                        <div>edite</div>
                    </a>
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
                <span class="text-red-600">{{ deleteItem.title }}</span>?
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
        }
    }
}
</script>
