<template>
    <div class="md:flex w-full font-mono h-screen justify-between">
        <div class="md:w-1/2 flex flex-wrap items-center justify-center">
            <div class="mx-10 lg:mx-0 w-full mt-20 lg:mt-0 lg:w-1/2">
                <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
                <div class="mt-4 w-full">
                    <label class="text-gray-400" for="name">Name</label>

                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Name" type="text" v-model="form.name">
                    <span class="text-red-500 text-xs italic mt-4" v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="mt-4 w-full">
                    <label for="email" class="text-gray-400">Your e-mail</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Email" type="email" v-model="form.email">
                    <span class="text-red-500 text-xs italic mt-4" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="mt-4 w-full">
                    <label for="password" class="text-gray-400">Password</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Password" type="password" v-model="form.password" name="password">
                    <span class="text-red-500 text-xs italic mt-4" v-if="errors.password">
                        {{ errors.password[0] }}
                    </span>

                </div>
                <div class="mt-4 w-full">
                    <label for="confirm_password" class="text-gray-400">Confirm Password</label>
                    <input
                        class="w-full shadow-sm text-gray-700 rounded-md border border-gray-200 focus:outline-none focus:border-gray-500 px-4 py-1"
                        placeholder="Confirm Password" type="password" v-model="form.password_confirmation"
                        name="password_confirmation">
                    <span class="text-red-500 text-xs italic mt-4" v-if="errors.password_confirmation">
                        {{ errors.password_confirmation[0] }}
                    </span>
                </div>
                <div class="w-full mt-8">
                    <button @click.prevent="saveForm" type="submit"
                            class="w-full text-white bg-gray-800 text-center border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded-md">
                        Register
                    </button>
                    <div @click="goToPage('Login')"
                         class="w-full mt-4 cursor-pointer">
                        Already have an account?
                        <Link href="/login" class="text-blue-500">Login</Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block w-1/2 md:flex md:flex-col"
             style="background-image: url('img/bg-login.jpg'); background-size: cover;">
            <div
                class="mt-auto p-8 text-white mb-20 mx-20 bg-gray-300 h-1/3 rounded bg-opacity-40 backdrop-blur border border-gray-200">
                <div class="text-lg">
                    Do you want to know about this site? Go to
                    <Link href="/"
                          class="font-bold cursor-pointer hover:text-gray-700">Home Page
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Register',
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
                console.log(error.response.data);
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
