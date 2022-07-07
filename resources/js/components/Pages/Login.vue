<template>
    <div class="flex w-full font-mono h-screen justify-between">
        <div class="w-1/2 flex flex-wrap items-center justify-center">
            <div>
                <div class="font-bold text-2xl text-gray-900">Login to your account</div>
                <div class="text-sm text-gray-400">Welcome back! Please enter your details.</div>
                <div class="mt-4 w-full">
                    <label for="email">Email</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 px-4 py-2"
                        placeholder="Enter your email"
                        type="email"
                        v-model="form.email">
                </div>
                <div class="mt-3 w-full">
                    <label for="password">Password</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-blue-500 px-4 py-2"
                        placeholder="Enter your password" type="password" v-model="form.password" name="password">
                </div>
                <div class="w-full mt-8">
                    <button @click.prevent="loginUser"
                            type="submit"
                            class="w-full text-white bg-gray-800 text-center border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">
                        Sign in
                    </button>

                    <div @click="goToRegisterPage"
                         class="w-full mt-4 cursor-pointer">
                        Don't have an account? <span class="text-blue-500">Register</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-1/2 flex flex-col" style="background-image: url('img/bg-login.jpg'); background-size: cover;">
            <div
                class="mt-auto p-8 text-white mb-20 mx-20 bg-gray-300 h-1/3 rounded bg-opacity-40 backdrop-blur border border-gray-200">
                <span class="text-lg font-bold">
                    Welcome Back!
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
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods: {
        loginUser() {
            axios.post('login', this.form)
                .then(() => {
                    this.$router.push({name: "Dashboard"});
                }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        goToRegisterPage() {
            this.$router.push({name: "Register"});
        }
    }
}
</script>
