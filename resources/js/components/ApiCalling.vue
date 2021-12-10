<template>
    <div class="api-calling container mt-5">
        <h1>Create Product</h1>
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
        <div class="form-group">
            <label>Name</label>
            <input v-model="product.name" type="text" class="form-control" placeholder="Name...">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input v-model="product.price" type="text" class="form-control" placeholder="Price...">
        </div>
        <button class="btn btn-primary" @click="createProduct">Create</button>

        <hr>
        <h1>List Products</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in listProducts" :key="product.id">
                <th scope="row">{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: {
                name: '',
                price: 0
            },
            listProducts: [],
            error: null,
            token : localStorage.getItem('token')
        }
    },

    created() {
        this.getListProducts()
    },
    methods: {
        async createProduct() {
            try {
                this.error = null
                window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                const response = await axios.post('/api/products', {
                    name: this.product.name,
                    price: this.product.price
                })

                this.listProducts.unshift(response.data.product)

                // reset giá trị form về ban đầu
                this.product = {
                    name: '',
                    price: 0}
            } catch (error) {
                this.error = error.response.data
            }
        },
        async getListProducts() {
            try {
                window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                const response = await axios.get('/api/products')
                this.listProducts = response.data

            } catch (error) {
                this.error = error.response.data
            }
        }
    }
}
</script>
