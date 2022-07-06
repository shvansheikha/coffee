<template>
    <div>
        <table v-if="gamesList != null && gamesList.length > 0"
               class="w-full text-sm text-left text-gray-500 cursor-pointer mt-4 shadow rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 text-xs  py-3">
                    Game
                </th>
                <th scope="col" class="px-2 text-xs  py-3">
                    Amount
                </th>

                <th scope="col" class="px-2 text-xs  py-3">
                    Started At
                </th>

                <th scope="col" class="px-2 text-xs  py-3">
                    Stopped At
                </th>

                <th scope="col" class="px-2 text-xs  py-3">
                    Price
                </th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="order in gamesList" class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 text-xs py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ order.orderable_title }}
                    <span class="text-xs">
                 ({{ order.orderable_group_title }})
                 </span>
                </th>
                <td class="px-2 text-xs py-4">
                    {{ order.amount }}
                </td>

                <td class="px-2 text-xs py-4">
                    {{ order.started_at }}
                </td>

                <td class="px-2 text-xs py-4">
                                <span v-if="(order.stopped_at != null)">
                                    {{ order.stopped_at }}
                                    ({{ order.diff }})
                                </span>
                    <span v-else>-</span>
                </td>

                <td class="px-2 text-xs py-4">
                    <span v-if="(order.price != null)">
                                    {{ order.price }}
                                </span>
                    <span v-else>-</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: 'BasketGamesTable',
    props: {
        gamesList: {}
    }
}
</script>
