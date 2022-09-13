<template>
    <div class="container">
        <h2>La pagina cercata non è stata trovata <span>¯\_(ツ)_/¯</span></h2>

        <p>Se cercavi i post del nostro blog li trovi <router-link :to="{name: 'blog'}">qui</router-link>.</p>
    </div>
</template>

<script>
export default {
    name: 'NotFound',
}
</script>

<style lang="scss" scoped>
    span {
        margin-left: 30px;
    }
    
    p {
        margin-top: 50px;
        font-size: 1.5rem;
    }
</style>