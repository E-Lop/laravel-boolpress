<template>
    <div class="container">
        <h1>Contattaci</h1>
        <form>
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input type="text"  v-model="userName" class="form-control" id="user-name">
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input type="email" v-model="userEmail" class="form-control" id="user-email">
            </div>
            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea class="form-control" v-model="userMessage" id="user-message" rows="10"></textarea>
            </div>
            <input type="submit" value="Invia" class="btn btn-primary">
        </form>
    </div>
</template>

<script>
export default {
    name: 'ContactPage',
    data() {
        return {
            userName: '',
            userEmail: '',
            userMessage: ''
        }
    }
}
</script>