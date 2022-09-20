<template>
    <div>
        <h3>Produtos</h3>
        <ul v-for="(product, index) in products" :key="index">
            <li>{{ product.nome }} - {{ product.cor }} - {{ product.tamanho }} - R$ {{ product.valor }}
                <button id="delete-btn" @click="deleteProduct(product.id)">APAGAR</button></li>
        </ul>
    </div>

    <form @submit.prevent="submitProduct">
        <input type="text" placeholder="Nome" v-model="newProduct.nome">
        <input type="text" placeholder="Cor" v-model="newProduct.cor">
        <input type="text" placeholder="Tamanho" v-model="newProduct.tamanho">
        <input type="number" placeholder="Valor" v-model="newProduct.valor">
        <input type="submit" value="Cadastrar produto" id="send-btn">
    </form>
</template>

<script>
import axios from 'axios'
export default {
    name: "Produtos",
    data() {
        return {
            products: null,
            newProduct: {
                nome: '',
                cor: '',
                tamanho: '',
                valor: '',
            }
        }
    },
    methods: {
        getProducts(){
            axios.get('http://localhost/api/produtos')
                .then(response => this.products = response.data)
        },
        submitProduct(){
            axios.post('http://localhost/api/produtos', this.newProduct)
                .then(response => {
                    this.getProducts()
                })
        },
        deleteProduct(id){
            axios.delete(`http://localhost/api/produtos/${id}`)
                .then(response => this.getProducts())
        }
    },
    mounted() {
        this.getProducts()
    }
}
</script>

<style scoped>
div {
    display: flex;
    flex-direction: column;
    align-items: center;
}
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.6rem;
}
input {
    width: 25%;
    outline: none;
    height: 25px;
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    padding: 5px;
}
#send-btn {
    border: none;
    background: #e2e8f0;
    height: 35px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}
#delete-btn {
    border: none;
    background: darkred;
    color: white;
    font-weight: bold;
    height: 25px;
    border-radius: 5px;
    cursor: pointer;
}
</style>
