<template>
    <div class="flex w-full font-mono h-screen justify-between">
        <div class="w-1/2 flex flex-wrap items-center justify-center">
            <div>
                <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
                <div class="p-2 w-full">
                    <label class="w-full" for="name">Name</label>
                    <span class="w-full text-red-500" v-if="errors.name">{{ errors.name[0] }}</span>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 text-base px-4 py-2"
                        placeholder="Name" type="text" v-model="form.name">
                </div>
                <div class="p-2 w-full">
                    <label for="email">Your e-mail</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 text-base px-4 py-2"
                        placeholder="Email" type="email" v-model="form.email">
                </div>
                <div class="p-2 w-full">
                    <label for="password">Password</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 text-base px-4 py-2"
                        placeholder="Password" type="password" v-model="form.password" name="password">
                </div>
                <div class="p-2 w-full">
                    <label for="confirm_password">Confirm Password</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 text-base px-4 py-2"
                        placeholder="Confirm Password" type="password" v-model="form.password_confirmation"
                        name="password_confirmation">
                </div>
                <div class="p-2 w-full mt-4">
                    <button @click.prevent="saveForm" type="submit"
                            class="w-full text-white bg-gray-800 text-center border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">
                        Register
                    </button>
                    <div @click="goToLoginPage"
                         class="w-full mt-4 cursor-pointer">
                        Already have an account? <span class="text-blue-500">Login</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-1/2 flex flex-col" style="background-image: url('img/bg-login.jpg'); background-size: cover;">
            <div
                class="mt-auto p-8 text-white mb-20 mx-20 bg-gray-300 h-1/3 rounded bg-opacity-40 backdrop-blur border border-gray-200">
                <span class="text-lg font-bold">
                    Register
                </span>
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
        goToLoginPage() {
            this.$router.push({name: "Login"});
        }
    }
}
</script>
