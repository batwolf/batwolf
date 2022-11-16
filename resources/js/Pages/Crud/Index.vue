<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import {computed, onMounted, ref} from "vue";
    import {getRoute, getSlashedRoute} from '@/Components/Routes.vue';
    const props = defineProps(['data', 'columns', 'name']);
    const items = ref([]);
    const currentSort = ref('id');
    const currentSortDir = ref('asc');
    const pageSize = ref(10);
    const currentPage = ref(1);
    const start = ref(0);
    const end = ref(0);
    const totalRecords = ref(0);
    const showingStart = ref(0);
    const showingEnd = ref(0);
    const totalPages = ref(1);
    const nextButtonIsVisible = ref(false);
    const prevButtonIsVisible = ref(false);
    const anyButtonIsVisible = ref(false);

    onMounted(() => {
        toggleNextButton();
        toggleAnyButton();
    });

    const capitalize = (str) => {
        return str[0].toUpperCase() + str.slice(1)
    }

    const sort = (s) => {
        if(s === currentSort.value) {
            currentSortDir.value = currentSortDir.value === 'asc'?'desc':'asc';
        }
        currentSort.value = s;
    };

    const toggleNextButton = () => {
        if (!nextPageIsVisible()) {
            nextButtonIsVisible.value = false;
        } else {
            nextButtonIsVisible.value = true;
        }
    }

    const togglePrevButton = () => {
        if (!previousPageIsVisible()) {
            prevButtonIsVisible.value = false;
        } else {
            prevButtonIsVisible.value = true;
        }
    }

    const toggleAnyButton = () => {
        if (!anyPageIsVisible()) {
            anyButtonIsVisible.value = false;
        } else {
            anyButtonIsVisible.value = true;
        }
    }

    const nextPage = () => {
        if((currentPage.value * pageSize.value) < props.data.length) {
            currentPage.value++;
        }
        toggleNextButton();
        togglePrevButton();
        toggleAnyButton();
    };

    const prevPage = () => {
        if(currentPage.value > 1) currentPage.value--;
        toggleNextButton();
        togglePrevButton();
        toggleAnyButton();
    }

    const nextPageIsVisible = () => {
        return currentPage.value !== (totalPages.value - 1);
    }

    const previousPageIsVisible = () => {
        return currentPage.value === 1;
    }

    const anyPageIsVisible = () => {
        return totalPages.value > 1;
    }

    const sortedItems = computed(() => {
        totalRecords.value = props.data.length;
        return props.data.sort((a,b) => {
            let modifier = 1;
            if(currentSortDir.value === 'desc') {
                modifier = -1;
            }
            if(a[currentSort.value] < b[currentSort.value]) {
                return -1 * modifier;
            }
            if(a[currentSort.value] > b[currentSort.value]) {
                return modifier;
            }
            return 0;
        }).filter((row, index) => {
            totalPages.value = Math.ceil(totalRecords.value/pageSize.value);
            start.value = (currentPage.value-1) * pageSize.value;
            end.value = currentPage.value * pageSize.value;
            showingStart.value = totalRecords.value < pageSize.value ? 1 : start.value + 1;
            showingEnd.value = totalRecords.value < pageSize.value ? totalRecords.value : end.value;
            toggleNextButton();
            togglePrevButton();
            toggleAnyButton();
            if(index >= start.value && index < end.value) {
                return true;
            }
        });
    });
</script>

<template>
    <Head :title="capitalize(name)" />
    <AuthenticatedLayout>
        <template #header>
            <div class="row">
                <div class="col-10">
                    <h3>{{ capitalize(name) }}</h3>
                </div>
                <div class="col-2">
                    <a :href="route(getRoute(name, 'create'))" name="addNew" id="addNew" class="btn btn-dark" ><vue-feather type="plus" /> Add</a>
                </div>
            </div>
        </template>
        <table class="table table-striped table-borderless table-hover">
            <caption>Showing {{ showingStart }} to {{ showingEnd }} of {{ totalRecords }} records [sorted by {{currentSort}} {{currentSortDir}}]</caption>
            <thead class="thead-dark">
                <tr>
                    <th class="sort" v-for="column in columns" @click="sort(column)">{{ column.toUpperCase() }}</th>
                    <th>ADMIN</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in sortedItems">
                    <td v-for="column in columns">{{ item[column] }}</td>
                    <td>
                        <a :href="getSlashedRoute(name, item['id'])" class="iconlink text-dark"><vue-feather type="eye" /></a>
                        <a :href="getSlashedRoute(name, item['id'], 'edit')" class="iconlink text-dark"><vue-feather type="edit" /></a>
                        <a href="#" class="iconlink text-danger"><vue-feather type="trash" /></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row" v-if="anyButtonIsVisible">
            <div class="col-1">
                <button :disabled="prevButtonIsVisible" class="btn btn-secondary" @click="prevPage">&lt;&lt;</button>
            </div>
            <div class="col-1">
                <button :disabled="nextButtonIsVisible" class="btn btn-secondary" @click="nextPage">&gt;&gt;</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
