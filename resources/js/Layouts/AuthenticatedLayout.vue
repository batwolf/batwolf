<script setup>
import SidebarLink from '@/Components/SidebarLink.vue';
</script>

<template>
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Company name</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">{{ $page.props.auth.user.name }}</a>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('dashboard.index')" :active="route().current('dashboard.*')">
                            <vue-feather type="clock" /> Dashboard
                        </SidebarLink>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>Components</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('users.index')" :active="route().current('users.*')">
                            <vue-feather type="users" /> Users
                        </SidebarLink>
                        <SidebarLink :href="route('products.index')" :active="route().current('products.*')">
                            <vue-feather type="clock" /> Products
                        </SidebarLink>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>Designer</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('designer.index')" :active="route().current('designer.*')">
                            <vue-feather type="image" /> Designer
                        </SidebarLink>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>Authentication</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('roles.index')" :active="route().current('roles.*')">
                            <vue-feather type="user-check" fill="#000000" /> Roles
                        </SidebarLink>
                        <SidebarLink :href="route('permissions.index')" :active="route().current('permissions.*')">
                            <vue-feather type="minus-circle" /> Permissions
                        </SidebarLink>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-uppercase">
                        <span>{{ $page.props.auth.user.name }}</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('logout')" :active="route().current('logout')">
                            <vue-feather type="star" fill="#000000" /> Profile
                        </SidebarLink>
                        <SidebarLink :href="route('logout')" :active="route().current('logout')">
                            <vue-feather type="log-out" fill="#000000" /> Logout
                        </SidebarLink>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100">
                <header class="pageTitle" v-if="$slots.header">
                    <slot name="header" />
                    <hr />
                </header>
                <slot />
            </main>
        </div>
    </div>
</template>

<style>

</style>
