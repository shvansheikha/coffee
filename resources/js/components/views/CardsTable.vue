<template>
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
                <div class="hover:text-blue-500 uppercase" @click="deleteCard(card.id)">Delete</div>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    name: 'CardTable',
    props: {
        cardsList: {}
    },
    methods: {
        deleteCard(id) {
            axios.delete('cards/' + id)
                .then((res) => {
                    console.log(res.status)
                    console.log(res.data)
                    this.$emit('delete');
                })
                .cache((error) => {
                    console.log(error)
                });
        }
    }
}
</script>
