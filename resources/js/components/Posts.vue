<template>
    <section>
        <div class="container">
            <h1>{{ pageTitle }}</h1>
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
