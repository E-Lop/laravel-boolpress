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

            <!-- paginazione -->
            <nav class="mt-3">
                <ul class="pagination">
                    <li class="page-item">
                        <a
                            class="page-link"
                            :class="{ 'disabled': currentPaginationPage == 1 }"
                            @click.prevent="getPosts(currentPaginationPage - 1)"
                            href="#"
                            >Previous</a
                        >
                    </li>
                    <li
                        v-for="pageNumber in lastPaginationPage"
                        :key="pageNumber"
                        class="page-item"
                    >
                        <a
                            @click.prevent="getPosts(pageNumber)"
                            class="page-link"
                            :class="{
                                'active': pageNumber == currentPaginationPage,
                            }"
                            href="#"
                            >{{ pageNumber }}</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            class="page-link"
                            :class="{
                                'disabled':
                                    currentPaginationPage == lastPaginationPage,
                            }"
                            @click.prevent="getPosts(currentPaginationPage + 1)"
                            href="#"
                            >Next</a
                        >
                    </li>
                </ul>
            </nav>
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
            currentPaginationPage: 1,
            lastPaginationPage: null,
        };
    },
    methods: {
        getPosts(pageNumber) {
            axios
                .get("/api/posts", {
                    params: {
                        page: pageNumber,
                    },
                })
                .then((response) => {
                    this.posts = response.data.results.data;
                    this.currentPaginationPage =
                        response.data.results.current_page;
                    this.lastPaginationPage = response.data.results.last_page;
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
        this.getPosts(1);
    },
};
</script>
