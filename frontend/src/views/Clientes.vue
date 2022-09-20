<template>
    <div>
        <h3>Clientes</h3>
        <ul v-for="cliente in clientes">
            <li>{{cliente.nome}} - {{cliente.cpf}} - {{cliente.sexo}} - {{cliente.email}}</li>
        </ul>
    </div>

    <form>
        <input type="text" placeholder="Nome">
        <input type="email" placeholder="Email">
        <input type="text" placeholder="CPF">
        <select name="" id="">
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
            clientes: null
        }
    },
    mounted () {
        axios.get('http://localhost/api/clientes')
            .then(response => this.clientes = response.data)
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
