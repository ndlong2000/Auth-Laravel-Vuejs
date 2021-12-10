<template>
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <div class="alert alert-danger alert-dismissible" role="alert" v-if="error">
                    <b>{{ error.message }}</b>
                    <ul>
                        <li v-for="(errorName, index) in error.errors" :key="index">
                            {{ errorName[0] }}
                        </li>
                    </ul>
                    <button type="button" class="close" @click="error = null">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div v-if="success == true">
                    <p>Dang ki thanh cong. Chuyen toi trang
                        <router-link
                            class="nav-link"
                            :to="{name: 'login'}"
                        >dang nhap
                        </router-link>
                    </p>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="id"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input v-model="user.id" type="text" name="id" id="id" placeholder="Your id"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input v-model="user.email" type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input v-model="user.password" type="password" name="password" id="password"
                                   placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input v-model="user.re_pass" type="password" name="re_pass" id="re-pass"
                                   placeholder="Repeat your password"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input v-model="user.name" type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="phone_number"><i class="zmdi zmdi-email"></i></label>
                            <input v-model="user.phone_number" type="text" name="phone_number" id="phone_number"
                                   placeholder="Phone number"/>

                        </div>
                        <div class="form-group">
                            <label for="address"><i class="zmdi zmdi-lock"></i></label>
                            <input v-model="user.address" type="text" name="address" id="address"
                                   placeholder="Address"/>
                        </div>
                    </div>
                </div>
                <div class="form-group form-button">
                    <button @click="createUser" class="form-submit">Register</button>
                </div>
                <router-link
                    class="nav-link"
                    :to="{name: 'login'}"
                >I am already member
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            user: {
                id: '',
                email: '',
                password: '',
                re_pass: '',
                name: '',
                phone_number: '',
                address: ''
            },
            // listProducts: [],
            error: null,
            success: false,
        }
    },
    methods: {
        async createUser() {
            try {
                this.error = null
                await axios.post('api/register', {
                    name: this.user.name,
                    id: this.user.id,
                    email: this.user.email,
                    password: this.user.password,
                    re_pass: this.user.re_pass,
                    phone_number: this.user.phone_number,
                    address: this.user.address
                }).then(response => {
                    this.success = true
                    //this.$router.push('login')
                })
            } catch (error) {
                this.error = error.response.data
                console.log(this.error)
            }
        },
    },

}
</script>

<style scoped src="">

</style>
