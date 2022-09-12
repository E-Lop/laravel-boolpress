<template>
    <section>
        <div class="container">
            <h1>{{ pageTitle }}</h1>

            <div class="row row-cols-3">
                <!-- single post card -->
                <div v-for="post in posts" :key="post.id" class="col">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text">
                                {{ truncateText(post.content) }}
                            </p>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            pageTitle: "Lista dei post",
            posts: [],
        };
    },
    methods: {
        getPosts() {
            axios.get("/api/posts").then((response) => {
                this.posts = response.data.results;
            });
        },
        truncateText(text) {
            if (text.length > 75) {
                return text.slice(0, 75) + "...";
            }
            return text;
        },
    },
    mounted() {
        this.getPosts();
    },
};
</script>
