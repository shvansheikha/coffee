<template>
    <div class="flex w-full h-screen">
        <div
            class="font-mono justify-center w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 h-screen flex shadow-inner overscroll-auto overflow-auto">
            <div class="w-3/4 mb-20">

                <div class="w-full flex justify-center mb-8">
                    <div>
                        <div class="text-4xl font-bold text-center text-gray-700">Coffee Game VALA</div>
<!--                        <div class="text-gray-600 mt-4">A free website to manage your coffee game shop!</div>-->
                    </div>
                </div>

                <div class="w-full flex justify-center">
                    <img src="img/coffee_with_friends.svg" class="h-56 mb-8">
                </div>

                <div class="flex justify-center mb-8 items-center hidden">
                    <div class="items-center justify-center text-center mx-4">
                        <div class="mb-4 text-4xl font-bold">Coffee</div>
                        <img src="img/coffee-logo.png" class="w-36">
                    </div>

                    <div class="text-4xl text-gray-800">&&</div>

                    <div class="items-center justify-center text-center mx-4">
                        <div class="mb-4 text-4xl font-bold">Game</div>
                        <img src="img/game.png" class="w-36">
                    </div>
                </div>

                <div class="w-full md:flex space-y-5 md:space-y-0 md:space-x-5 text-gray-700 text-sm">

                    <div class="shadow hover:shadow-lg border md:w-1/3 bg-white cursor-pointer transition duration-200
                 ease-in-out transform rounded-lg flex flex-col justify-between p-3">
                        <div class="w-full flex justify-center items-center bg-gray-back py-8 rounded-lg">
                            <img src="img/report.png" class="w-full h-36">
                        </div>
                        <div class="px-2 mt-3">
                            <span>Daily report!</span>
                        </div>
                    </div>

                    <div class="shadow hover:shadow-lg border md:w-1/3 bg-white cursor-pointer transition duration-200
                 ease-in-out transform rounded-lg flex flex-col justify-between p-3">
                        <div class="w-full flex justify-center items-center bg-gray-back py-8 rounded-lg">
                            <img src="img/unlimited.png" class="w-full h-36">
                        </div>
                        <div class="px-2 mt-3">
                            <span>Add unlimited products</span>
                        </div>
                    </div>

                    <div class="shadow hover:shadow-lg border md:w-1/3 bg-white cursor-pointer transition duration-200
                 ease-in-out transform rounded-lg flex flex-col justify-between p-3">
                        <div class="w-full flex justify-center items-center bg-gray-back py-8 rounded-lg">
                            <img src="img/save.png" class="w-full h-36">
                        </div>
                        <div class="px-2 mt-3">
                            <span>Free to use</span>
                        </div>
                    </div>
                </div>

                <!-- About -->
                <div>
                    <div class="w-full mt-2 hidden">
                        Hey!<br>
                        This site help you to manage your coffee business!<br>
                        <h1>Don't forget this is a <span class="cursor-pointer text-blue-500 font-bold">Free</span> use
                            site! enjoy
                            that!</h1>
                        Create some <span class="cursor-pointer text-blue-500">#Cards</span> and manage your customers
                        by them.<br>
                        Each customer can order or play with their cards.<br>
                        Finally you can see what they ordered and how much should pay!<br>
                        The big point is you can see how many customer you had each day! and what did they
                        ordered<br>
                        Generally you can see history of your sells!<br>
                        You can groups your products and games.<br>
                        like <br>
                        - Coffee<br>
                        <div class="px-4">
                            - Espresso<br>
                            - Breve<br>
                            - Cafe Latte<br>
                            - Double Espress<br>
                        </div>
                        - PS4<br>
                        <div class="px-4">
                            - One Person PS4<br>
                            - Two Person PS4<br>
                            - Three Person PS4<br>
                        </div>
                        And customers can order some coffee by the card!<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


export default {
    name: "Home",
    components: {},
}
</script>
