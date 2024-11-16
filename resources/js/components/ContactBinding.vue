<template>
    <v-container>
        <v-form @submit.prevent="bindContact">
            <v-text-field v-model="name" label="Имя контакта" required></v-text-field>
            <v-text-field v-model="phone" label="Телефон" required></v-text-field>
            <v-textarea v-model="comment" label="Комментарий" required></v-textarea>
            <v-btn type="submit" color="primary">Привязать</v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            phone: '',
            comment: ''
        };
    },
    methods: {
        bindContact() {
            const contactData = {
                name: this.name,
                phone: this.phone,
                comment: this.comment
            };
            this.$store.dispatch('bindContact', {
                dealId: this.$route.params.dealId,
                contactData
            });
            this.$router.push('/');
        }
    }
};
</script>
