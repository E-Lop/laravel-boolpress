<template>
    <div class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>

            <img class="w-50" v-if="post.cover" :src="post.cover" :alt="post.title">

            <div v-if="post.tags.length > 0">
                <span v-for="tag in post.tags" :key="tag.id" class="badge bg-info text-dark mr-1">{{ tag.name }}</span>
            </div>

            <div v-if="post.category">
                Categoria: {{ post.category.name }}
            </div>
            <p class="mt-3"> {{ post.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    mounted() {
        axios.get('/api/posts/' + this.$route.params.slug)
        .then((response) => {
             // Se abbiamo trovato un post ok popoliamo this.post e lo stampiamo
            if(response.data.success) {
                this.post = response.data.results;
            } else {
                // Altrimeneti se il post non è stato trovato reindirizziamo l'utente a 404
                this.$router.push({name: 'not-found'});
            }
        })
    }
}
</script>