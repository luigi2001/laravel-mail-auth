<template>
    <header>
        <div class="logo">
            <h1>Boolpress blog</h1>
            <ul>
                <li><router-link :to="{ name: 'home' }">Home</router-link></li>
                <li><router-link :to="{ name: 'contact' }">Contatti</router-link></li>
                <li><router-link :to="{ name: 'about' }">Chi siamo</router-link></li>
            </ul>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
header{
    height: 200px;
    padding: 20px;
    text-align: center;
    .logo{
        padding: 10px;
        background-color: yellow;
        border: 5px solid blue;
        border-radius: 15px;
        ul{
        list-style: none;
        li{
            display: inline-block;
            margin-right: 20px;
        }
    }
    }
}
</style>