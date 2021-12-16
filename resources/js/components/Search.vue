<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">'Search for user by ID'</div>
                    <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="user_id" id="user_id" class="form-control" name="user_id" type="number" placeholder="Product Id" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-5">
                                    <button @click="search" class="btn btn-primary">
                                        Search
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Search",
    data() {
        return {
            user_id : null,
        }
    },
    methods : {
        async search() {
            try {
                axios.post('api/products/search',{
                    user_id : this.user_id
                })
            } catch (error) {
                this.error = error.response.data
                console.log(this.error)
            }
        }
    },
    // watch: {
    //     user_id() {
    //         console.log('user_id change')
    //     }
    // }
}
</script>

<style scoped>

</style>
