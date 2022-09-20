<template>
    <div>
        <h3>Pedidos</h3>
        <ul v-for="(pedido, index) in pedidos" :key="index">
            <li>{{ pedido.data_pedido }} - Obs: {{ pedido.observacao }} - Pagamento: {{ pedido.forma_pagamento }} - Objetos: {{ pedido.item.nome }} - R$ {{ pedido.item.valor }} <button id="delete-btn" @click="deletePedido(pedido.id)">APAGAR</button> <button id="email-btn" @click="email(pedido.id, pedido.user_id)">EMAIL</button></li>
        </ul>
        <p v-show="emailTag">Email enviado com sucesso!</p>
        <p v-show="emailTagFailed">Houve um problema ao enviar o email</p>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "Pedidos",
    data() {
        return {
            pedidos: null,
            emailTag: false,
            emailTagFailed: false
        }
    },
    methods: {
        getPedidos(){
            axios.get('http://localhost/api/pedidos')
                .then(response => this.pedidos = response.data)
        },
        deletePedido(id) {
            axios.delete(`http://localhost/api/pedidos/${id}`)
                .then(response => this.getPedidos())
        },
        email(id, client_id) {
            axios.post(`http://localhost/api/pedidos/${id}/sendmail`, {client_id})
                .then(response => {
                   if(response.status != 200) {
                       this.emailTagFailed = true
                   }
                   this.emailTag = true
                });
        }
    },
    mounted() {
        this.getPedidos()
    }
}
</script>

<style scoped>
div {
    display: flex;
    flex-direction: column;
    align-items: center;
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
#email-btn {
    border: none;
    background: cornflowerblue;
    color: white;
    font-weight: bold;
    height: 25px;
    border-radius: 5px;
    cursor: pointer;
}
</style>
