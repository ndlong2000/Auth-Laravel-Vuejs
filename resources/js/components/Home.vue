<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <router-link class="nav-link" :to="{name: 'api_calling'}">Trang san pham</router-link>
            <div class="card card-default">
                <div class="card-header">Home</div>

                <div class="card-body">
                    I'm the Home Component component.
                </div>

                <div class="form-group form-button">
                    <button @click="logout1" class="form-submit">Log Out</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            token: localStorage.getItem('token'),
            currentUser: null,
        }
    },
    methods: {
        async logout() {
            try {
                await axios.post('api/logout')
                    .then(response => {
                        this.$router.push('login')
                    })
            } catch (error) {
                this.error = error.response.data
                console.log(this.error)
            }
        },

        logout1() {
            axios.post('api/logout').then((response) => {
                localStorage.removeItem('token')
                this.$router.push('/login')
            }).catch((errors) => {
                console.log(errors)
            })
        }
    },

}
</script>

<style scoped>

</style>
