<template>
  <div class="app-shell">
    <header class="app-header">
      <nav class="app-nav">
        <NuxtLink to="/" class="nav-logo">
          Nuxt Frontend
        </NuxtLink>
        <div class="nav-links">
          <NuxtLink to="/" class="nav-link" exact-active-class="nav-link-active">Home</NuxtLink>
          <NuxtLink to="/login" class="nav-link" exact-active-class="nav-link-active">Login</NuxtLink>
          <NuxtLink to="/registration" class="nav-link" exact-active-class="nav-link-active">Registration</NuxtLink>
        </div>
      </nav>
    </header>

    <main class="main-container">
      <slot />
    </main>

    <footer class="app-footer">
      <div class="app-footer-inner">
        © {{ currentYear }} Nuxt Frontend. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
const currentYear = new Date().getFullYear();
</script>
