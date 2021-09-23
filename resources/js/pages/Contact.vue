<template>
    <div>
        <form @submit.prevent="sendForm">
            <div v-if="success" class="alert alert-success">
                Messaggio inviato
            </div>
             <div class="mb-3">
                <label for="name" class="form-label">nome</label>
                <input v-model="name" type="text" class="form-control" id="name">
                <p class="alert alert-danger" v-for="(error,index) in errors.name" :key="index">
                    {{error}}
                </p>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="email" type="email" class="form-control" id="email">
                <p class="alert alert-danger" v-for="(error,index) in errors.email" :key="index">
                    {{error}}
                </p>
            </div>
            <div class="mb-3">
                <label for="msg" class="form-label">messaggio</label>
                <textarea v-model="message" name="message" class="form-control" id="msg" cols="30" rows="10"></textarea>
                <p class="alert alert-danger" v-for="(error,index) in errors.message" :key="index">
                    {{error}}
                </p>
            </div>
            <button type="submit" class="btn btn-primary">{{ sending ? '...' : 'Submit' }}</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'Contact',
    data(){
        return{
            name: '',
            email: '',
            message: '',
            errors: {},
            sending: false,
            success: false
        }
    },
    methods: {
        sendForm(){
            this.sending = true;
            this.success = false;
            axios.post('/api/contacts', {
                'name': this.name,
                'email': this.email,
                'message': this.message
            }).then(response => {
                if(response.data.success){
                    this.success = true;
                    this.sending = false;
                }else{
                    this.errors = response.data.errors;
                    this.success = false;
                    this.sending = false;
                }
                
            });
                  
        }
    }
}
</script>

<style lang="scss" scoped>

</style>