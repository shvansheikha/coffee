<template>
    <div class="md:flex w-full font-mono h-screen justify-between">
        <div class="md:w-1/2 flex flex-wrap items-center justify-center">
            <div class="mx-10 lg:mx-0 w-full mt-20 lg:mt-0 lg:w-1/2">
                <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
                <div class="mt-4 w-full">
                    <label class="text-gray-400" for="name">Name</label>
                    <span class="w-full text-red-500" v-if="errors.name">{{ errors.name[0] }}</span>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Name" type="text" v-model="form.name">
                </div>
                <div class="mt-4 w-full">
                    <label for="email" class="text-gray-400">Your e-mail</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Email" type="email" v-model="form.email">
                </div>
                <div class="mt-4 w-full">
                    <label for="password" class="text-gray-400">Password</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Password" type="password" v-model="form.password" name="password">
                </div>
                <div class="mt-4 w-full">
                    <label for="confirm_password" class="text-gray-400">Confirm Password</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Confirm Password" type="password" v-model="form.password_confirmation"
                        name="password_confirmation">
                </div>
                <div class="w-full mt-8">
                    <button @click.prevent="saveForm" type="submit"
                            class="w-full text-white bg-gray-800 text-center border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded-md">
                        Register
                    </button>
                    <div @click="goToPage('Login')"
                         class="w-full mt-4 cursor-pointer">
                        Already have an account? <span class="text-blue-500">Login</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block w-1/2 md:flex md:flex-col" style="background-image: url('img/bg-login.jpg'); background-size: cover;">
            <div
                class="mt-auto p-8 text-white mb-20 mx-20 bg-gray-300 h-1/3 rounded bg-opacity-40 backdrop-blur border border-gray-200">
                <div class="text-lg">
                    Do you want to know about this site? Go to
                    <span class="font-bold cursor-pointer hover:text-gray-700" @click="goToPage('Home')">Home Page</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: []
        }
    },
    methods: {
        saveForm() {
            axios.post('register', this.form).then(() => {
                console.log('saved');
                this.$router.push({name: "Dashboard"});
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        goToPage(page) {
            this.$router.push({name: page});
        }
    }
}
</script>
