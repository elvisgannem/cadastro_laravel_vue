<template>
    <nav>
        <h2>CadastroApp</h2>
        <ul>
            <li>Clientes</li>
            <li>Produtos</li>
            <li>Pedidos</li>
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
