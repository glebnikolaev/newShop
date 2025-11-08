<template>
  <section class="form-card">
    <h1 class="form-title">Login</h1>
    <p class="form-subtitle">
      Access your account to continue.
    </p>

    <form class="form-grid" @submit.prevent>
      <div class="form-field">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" placeholder="name@example.com" class="form-input" />
      </div>

      <div class="form-field">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" placeholder="Your password" class="form-input" />
      </div>

      <button type="submit" class="form-submit">
        Sign In
      </button>
    </form>

    <p class="form-footer">
      Need an account?
      <NuxtLink to="/registration">
        Register here
      </NuxtLink>
    </p>
  </section>
</template>
