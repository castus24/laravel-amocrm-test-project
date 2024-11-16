import DealSelection from '../pages/DealSelection.vue';
import History from '../pages/History.vue';

export default [
    {
        path: '/',
        name: 'deals',
        component: DealSelection,
    },
    {
        path: '/history',
        name: 'history',
        component: History,
    },
];
