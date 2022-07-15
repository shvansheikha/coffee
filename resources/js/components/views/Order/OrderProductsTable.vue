<template>
    <div v-if="productsList != null && productsList.length > 0">
        <div class="w-full bg-white text-sm text-left text-gray-500 cursor-pointer rounded-md shadow-lg">
            <div
                class="text-gray-700 uppercase bg-gray-50 border-b md:flex justify-between font-medium rounded-t-md hidden md:visible">

                <div class="text-center px-3 py-3 md:w-1/12">
                    #
                </div>

                <div class="px-3 py-3 md:w-4/12">
                    Title
                </div>

                <div class="px-3 py-3 md:w-3/12">
                    Count
                </div>

                <div class="px-3 py-3 md:w-2/12">
                    Amount
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    Price
                </div>

                <div class="px-3 py-3 md:w-1/12 items-center flex justify-center">
                    Delete
                </div>
            </div>

            <div v-for="(order, index) in productsList"
                 class="w-full hover:bg-gray-50 md:flex md:justify-between font-medium"
                 :class="(index === productsList.length -1 )?'md:hover:rounded-b-md':'border-b'">

                <div class="hidden md:block text-center px-3 py-3 md:w-1/12 lg:w-1/12">
                    {{ index + 1 }}
                </div>

                <div class="px-3 py-3 md:w-4/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Title:</span>
                    <span>{{ order.orderable_title }}</span>
                </div>

                <div class="px-3 py-3 md:w-3/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Count:</span>
                    <span>{{ order.number }}</span>
                </div>

                <div class="px-3 py-3 md:w-2/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Amount:</span>
                    <span>{{ format(order.amount) }}</span>
                </div>

                <div class="px-3 py-3 md:w-1/12">
                    <span class="md:hidden uppercase text-gray-700 mr-2 font-medium">Price:</span>
                    <span v-if="(order.price != null)">{{ format(order.price) }}</span>
                    <span v-else>-</span>
                </div>

                <div class="px-3 py-3 md:px-0 md:py-0 md:w-1/12">

                    <div
                        @click="confirmDelete(order)"
                        class="w-full px-3 py-2 rounded-md md:rounded-none bg-gray-800 text-gray-200 md:text-inherit md:bg-inherit items-center flex justify-center hover:text-blue-500 uppercase">
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
            <h2 class="text-lg font-bold text-gray-900">Delete Order</h2>
            <span class="mb-6 text-sm">
                Do you really want to delete
                <span class="text-red-600">{{ deleteItem.orderable_title }}</span>?
            </span>

            <div class="flex mt-8">
                <button
                    class="px-4 py-1 rounded-md border hover:border-blue-500 hover:text-blue-500"
                    @click="deleteOrder(deleteItem.id)">
                    Yes
                </button>

                <button
                    class="px-4 py-1 rounded-md border ml-4 hover:border-blue-500 hover:text-blue-500"
                    @click="modalShowing = false">
                    Close
                </button>
            </div>
        </Modal>

    </div>

</template>

<script>

import Modal from "../../utility/Modal";

export default {
    name: 'OrderProductsTable',
    components: {Modal},
    props: {
        productsList: {}
    },
    data() {
        return {
            deleteItem: null,
            modalShowing: false,
        }
    },
    methods: {
        format(value) {
            return value.toString().replace(/(\d)(?=(\d{3})+([^\d]|$))/g, '$1,')
        },
        confirmDelete(item) {
            this.deleteItem = item;
            this.modalShowing = true;
        },
        deleteOrder(id) {
            this.deleteItem = null;
            this.modalShowing = false;
            axios.delete('orders/' + id)
                .then((res) => {
                    this.$emit('delete');
                }).catch((error) => {
                console.log(error.response.data.errors)
            });
        }
    }
}
</script>

