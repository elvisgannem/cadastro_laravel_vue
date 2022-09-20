<template>
    <div>
        <h3>Clientes</h3>
        <ul v-for="(cliente, index) in clientes" :key="index">
            <li>{{cliente.nome}} - {{cliente.cpf}} - {{cliente.sexo}} - {{cliente.email}}</li>
        </ul>
    </div>

    <form @submit.prevent="submitClient">
        <input type="text" placeholder="Nome" v-model="newClient.nome">
        <input type="email" placeholder="Email" v-model="newClient.email">
        <input type="text" placeholder="CPF" v-model="newClient.cpf">
        <select v-model="newClient.sexo">
            <option value="H">Homem</option>
            <option value="M">Mulher</option>
        </select>
        <input type="submit" value="Cadastrar cliente" id="send-btn">
    </form>
</template>

<script>
import axios from 'axios';
export default {
    name: "Clientes",
    data() {
        return {
            clientes: null,
            newClient: {
                nome: '',
                email: '',
                cpf: '',
                sexo: 'H'
            }
        }
    },
    methods: {
      submitClient(){
          axios.post('http://localhost/api/clientes', this.newClient)
              .then(response => {
                  this.getClients()
              })
      },
      getClients(){
          axios.get('http://localhost/api/clientes')
              .then(response => this.clientes = response.data)
      }
    },
    mounted () {
        this.getClients()
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
</style>
