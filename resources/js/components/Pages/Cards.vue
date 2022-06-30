<template>
    <div class="flex w-full font-mono">

        <SideBar></SideBar>

        <div class="w-full px-4 pt-6 pb-20 md:px-40 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div class="flex items-center pb-4 mb-4 border-b">
                <input type="text"
                       name="title"
                       v-model="form.title"
                       class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Enter Title">

                <button
                    @click="submitForm"
                    type="submit"
                    class="w-52 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                    Create
                </button>
            </div>

            <CardsTable :cards-list="cardsList" @delete="getCardsList"></CardsTable>
        </div>
    </div>
</template>
<script>


import SideBar from "../utility/SideBar";
import CardsTable from "../views/CardsTable";

export default {
    components: {CardsTable, SideBar},
    data() {
        return {
            form: {
                title: null
            },
            cardsList: null,
        }
    },
    created() {
        this.getCardsList();
    },
    methods: {
        submitForm() {
            axios.post('cards', this.form)
                .then((res) => {
                    if (res.status === 201) {
                        this.getCardsList();
                    }
                    this.form.title = "";
                })
                .catch((error) => {
                    // console.log(error)
                });
        },
        getCardsList() {
            axios.get('cards')
                .then((res) => {
                    this.cardsList = res.data.data;
                })
        }
    }
}
</script>
