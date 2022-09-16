<template>
    <div class="container">
        <h1>Contattaci</h1>

        <div v-if="success" class="alert alert-success" role="alert">
            Grazie per averci contattato
        </div>
        
        <form @submit.prevent="sendMessage">
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
    },
    methods: {
        sendMessage() {
            axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage
            })
            .then((response) => {
                if(response.data.success) {
                    this.success = true;

                    this.userName = '';
                    this.userEmail = '';
                    this.userMessage = '';
                }                
            });
        }
    }
}
</script>