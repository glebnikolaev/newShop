<template>
  <section>
    <div class="hero-card">
      <h1 class="hero-heading">
        Welcome to the new Nuxt Frontend
      </h1>
      <p class="hero-subtitle">
        This lightweight interface is powered by the latest Nuxt release and provides a clean starting point for Home, Login, and Registration flows.
      </p>
      <div class="hero-actions">
        <NuxtLink to="/login" class="btn btn-primary">
          Go to Login
        </NuxtLink>
        <NuxtLink to="/registration" class="btn btn-secondary">
          Create an Account
        </NuxtLink>
      </div>
    </div>

    <div class="feature-grid">
      <article class="feature-card">
        <h2>Nuxt Fundamentals</h2>
        <p>
          Nuxt streamlines application architecture with file-based routing, auto-imported components, and server-side rendering ready for production.
        </p>
      </article>
      <article class="feature-card">
        <h2>Composable-First Design</h2>
        <p>
          Leverage Vue 3&apos;s composition API and Nuxt composables to build feature-rich experiences while keeping your codebase maintainable.
        </p>
      </article>
    </div>
  </section>
</template>
