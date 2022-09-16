<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li v-for="link, index in menuLinks" :key="index" class="nav-item">
                        <router-link :to="{ name: link.name }" class="nav-link">{{ link.label }}</router-link>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'MainHeader',
    data() {
        return {
            menuLinks: [
                {
                    name: 'home',
                    label: 'Home'
                },
                {
                    name: 'about',
                    label: 'About'
                },
                {
                    name: 'blog',
                    label: 'Blog'
                },
                {
                    name: 'contact',
                    label: 'Contatti'
                }
            ],
        }
    }
}
</script>