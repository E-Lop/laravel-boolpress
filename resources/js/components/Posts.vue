<template>
    <section>
        <div class="container">
            <h1>{{ pageTitle }}</h1>

            <div class="row row-cols-3">
                <!-- single post card -->
                <div class="col">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card
                                title and make up the bulk of the card's
                                content.
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
        };
    },
};
</script>
