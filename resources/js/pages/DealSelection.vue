<template>
    <v-container>
        <v-data-table :items="deals" :headers="headers" item-key="id">
            <template v-slot:items="props">
                <td>{{ props.item.id }}</td>
                <td>{{ props.item.name }}</td>
                <td>{{ props.item.created_at }}</td>
                <td>{{ props.item.contact ? 'Да' : 'Нет' }}</td>
                <td>
                    <v-btn @click="bindContact(props.item.id)" :disabled="props.item.contact">Привязать контакт</v-btn>
                </td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            headers: [
                { text: 'ID', align: 'start', key: 'id' },
                { text: 'Название', align: 'start', key: 'name' },
                { text: 'Дата создания', align: 'start', key: 'created_at' },
                { text: 'Есть контакт', align: 'start', key: 'contact' },
                { text: 'Действия', align: 'start' }
            ]
        };
    },
    computed: {
        deals() {
            return this.$store.getters.getDeals;
        }
    },
    methods: {
        bindContact(dealId) {
            this.$router.push(`/bind-contact/${dealId}`);
        }
    },
    mounted() {
        this.$store.dispatch('fetchDeals');
    }
};
</script>
