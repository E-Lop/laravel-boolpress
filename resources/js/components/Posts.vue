<template>
    <section>
        <div class="container">
            <h2>{{ title }}</h2>

            <div class="row row-cols-3">
                <!-- single post card -->
                <div v-for="singlePost in posts" :key="singlePost.id" class="col">
                    <PostDetails :post="singlePost"/>
                </div>
            </div>

            <!-- paginazione -->
            <nav class="mt-3">
                <ul class="pagination">
                    <li class="page-item">
                        <a
                            :class="[
                                { 'disabled': currentPaginationPage == 1 }, 
                                'page-link btn'
                            ]"
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
                            class="page-link btn"
                            :class="{
                                'active': pageNumber == currentPaginationPage,
                            }"
                            href="#"
                            >{{ pageNumber }}</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            class="page-link btn"
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
import PostDetails from './PostDetails.vue';
export default {
    name: "Posts",
    components: {
        PostDetails
    },
    data() {
        return {
            title: "Lista dei post",
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
        }
    },
    mounted() {
        this.getPosts(1);
    },
};
</script>

<style lang="scss" scoped>
    
</style>
