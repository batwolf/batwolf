<script setup>
import SidebarLink from '@/Components/SidebarLink.vue';
</script>

<template>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
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
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Components</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <vue-feather type="pie-chart" /> Dashboard
                        </SidebarLink>
                        <SidebarLink :href="route('users.index')" :active="route().current('users.*')">
                            <vue-feather type="users" /> Users
                        </SidebarLink>
                        <SidebarLink :href="route('roles.index')" :active="route().current('roles.*')">
                            <vue-feather type="user-check" /> Roles
                        </SidebarLink>
                        <SidebarLink :href="route('permissions.index')" :active="route().current('permissions.*')">
                            <vue-feather type="minus-circle" /> Permissions
                        </SidebarLink>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>{{ $page.props.auth.user.name }}</span>
                    </h6>
                    <ul class="nav flex-column">
                        <SidebarLink :href="route('logout')" :active="route().current('logout')">
                            <vue-feather type="log-out" /> Logout
                        </SidebarLink>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 1000;
    padding: 48px 0 0; /* Height of navbar */
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
    }
}

.sidebar-sticky {
    height: calc(100vh - 48px);
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.nav-link {
    font-weight: 400;
    color: #333 !important;
}

.sidebar .nav-link.active {
    color: #333 !important;
    background: #efefef !important;
}

.sidebar .nav-link:hover {
    color: #333 !important;
    background: #eaeaea !important;
}

.sidebar-heading {
    font-size: .75rem;
}

.navbar-brand {
    padding-top: .75rem;
    padding-bottom: .75rem;
    background-color: rgba(0, 0, 0, .25);
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .navbar-toggler {
    top: .25rem;
    right: 1rem;
}

.navbar .form-control {
    padding: .75rem 1rem;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}

.pageTitle {
    margin-top: 20px !important;
}

.vue-feather {
    background: transparent;
    text-decoration: none;
    align-items: center;
    margin-bottom: -2px;
    width: 16px;
}

.iconlink {
    margin-right: 10px;
}

th.sort {
    cursor: pointer;
}

</style>
