<template>
    <v-container>
        <v-data-table :items="history" :headers="headers" item-key="date">
            <template v-slot:items="props">
                <td>{{ props.item.date }}</td>
                <td>{{ props.item.action }}</td>
                <td>{{ props.item.result }}</td>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            headers: [
                { text: 'Дата и время', align: 'start', key: 'date' },
                { text: 'Действие', align: 'start', key: 'action' },
                { text: 'Результат', align: 'start', key: 'result' }
            ]
        };
    },
    computed: {
        history() {
            return this.$store.getters.getHistory;
        }
    },
    mounted() {
        this.$store.dispatch('fetchHistory');
    }
};
</script>
