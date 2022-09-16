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

            <div v-if="errors.name">
                <div v-for="error, index in errors.name" :key="index" class="alert alert-danger">
                    {{ error }}
                </div>
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input type="email" v-model="userEmail" class="form-control" id="user-email">
            </div>

            <div v-if="errors.email">
                <div v-for="error, index in errors.email" :key="index" class="alert alert-danger">
                    {{ error }}
                </div>
            </div>

            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea class="form-control" v-model="userMessage" id="user-message" rows="10"></textarea>
            </div>

            <div v-if="errors.message">
                <div v-for="error, index in errors.message" :key="index" class="alert alert-danger">
                    {{ error }}
                </div>
            </div>

            <input type="submit" value="Invia" class="btn btn-primary" :disabled="sending">
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
            userMessage: '',
            success: false,
            errors: {},
            sending: false
        };
    },
    methods: {
        sendMessage() {
            this.sending = true,

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
                } else {
                    this.errors = response.data.errors;
                }
                this.sending = false;
            });
        }
    }
}
</script>