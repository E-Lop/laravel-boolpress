<template>
    <div class="card mt-4">
        <div class="card-body">
            <img class="w-100" v-if="post.cover" :src="post.cover" :alt="post.title">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">
                {{ truncateText(post.content) }}
            </p>
            <router-link 
                class="btn btn-primary" 
                :to="{
                    name: 'single-post',
                    params: { slug: post.slug }
                    }"
            >
                Leggi
            </router-link>
        </div>
    </div> 
</template>

<script>
export default {
    name: 'PostDetails',
    props: {
        post: Object
    },
    methods: {
        truncateText(text) {
            if (text.length > 75) {
                return text.slice(0, 75) + "...";
            }
            return text;
        }
    }
}
</script>