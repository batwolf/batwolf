<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
<script>
export default {
    props: ['users'],
    data() {
      return {
          items:[],
          currentSort:'name',
          currentSortDir:'asc',
          pageSize: 1,
          currentPage: 1,
          start: 0,
          end: 0,
          totalRecords: 0,
          showingStart: 0,
          showingEnd: 0,
      }
    },
    methods:{
        sort:function(s) {
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            }
            this.currentSort = s;
        },
        nextPage:function() {
            if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
        },
        prevPage:function() {
            if(this.currentPage > 1) this.currentPage--;
        }
    },
    computed: {
        sortedItems: function() {
            this.totalRecords = this.users.length;
            return this.users.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return modifier;
                return 0;
            }).filter((row, index) => {
                this.start = (this.currentPage-1)*this.pageSize;
                this.end = this.currentPage*this.pageSize;
                this.showingStart = this.totalRecords < this.pageSize ? this.totalRecords : this.start + 1;
                this.showingEnd = this.totalRecords < this.pageSize ? this.totalRecords : this.end;
                if(index >= this.start && index < this.end) return true;
            });
        }
    }
}
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <h3>Users</h3>
        </template>
        <table class="table table-striped table-borderless table-hover">
            <caption>Showing {{ showingStart }} to {{ showingEnd }} of {{ totalRecords }} records, sorted by {{currentSort}}, {{currentSortDir}}</caption>
            <thead class="thead-dark">
                <tr>
                    <th @click="sort('id')">ID</th>
                    <th @click="sort('name')">Name</th>
                    <th @click="sort('email')">Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in sortedItems">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>
            <button class="btn btn-secondary" @click="prevPage">Prev</button>
            <button class="btn btn-secondary" @click="nextPage">Next</button>
        </p>
    </AuthenticatedLayout>
</template>
