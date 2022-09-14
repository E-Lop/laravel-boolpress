<template>
    <div class="container">
        <h2>Pagina di dettaglio del singolo post</h2>

        {{ $route.params.slug }}
    </div>
</template>

<script>
export default {
    name: 'SinglePost'
}
</script>