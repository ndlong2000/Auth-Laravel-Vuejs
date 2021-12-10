<template>
    <div class="container">
        <div class="signin-content">
            <div class="signin-form">
                <h2 class="form-title">Sign up</h2>
                <div class="form-group">
                    <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                    <input v-model="user.email" type="text" name="email" id="your_name" placeholder="Your Name"/>
                </div>
                <div class="form-group">
                    <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                    <input v-model="user.password" type="password" name="password" id="your_pass" placeholder="Password"/>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"/>
                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                </div>
                <div class="form-group form-button">
                    <button @click="login" class="form-submit">Login</button>
                </div>
                <router-link
                    class="nav-link"
                    :to="{name: 'register'}"
                >Create an account
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            user : {
                email : '',
                password : '',
                device_name: 'browser'
            },
            error: null,
        }
    },
    methods : {
        async login() {
            try {
                await axios.post('api/login', this.user)
                    .then(response => {
                        localStorage.setItem('token', response.data)
                        this.$router.push({name : 'home'})
                    })
            } catch (error) {
                this.error = error.response.data
                console.log(this.error)
            }
        }
    }
}
</script>

<style scoped>

</style>
