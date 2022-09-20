<template>
    <nav>
        <h2>CadastroApp</h2>
        <ul>
            <router-link to="/"><li>Clientes</li></router-link>
            <router-link to="/produtos"><li>Produtos</li></router-link>
            <router-link to="/pedidos"><li>Pedidos</li></router-link>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Navbar"
}
</script>

<style scoped>

nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 4rem;
    background: #e2e8f0;
}

ul {
    display: flex;
    gap: 1rem;
    list-style-type: none;
}

</style>
