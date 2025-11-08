<template>
  <section class="form-card">
    <h1 class="form-title">Create an account</h1>
    <p class="form-subtitle">
      Join the platform in just a few steps.
    </p>

    <form class="form-grid" @submit.prevent>
      <div class="form-grid two-columns">
        <div class="form-field">
          <label for="first-name" class="form-label">First name</label>
          <input id="first-name" type="text" placeholder="Jane" class="form-input" />
        </div>
        <div class="form-field">
          <label for="last-name" class="form-label">Last name</label>
          <input id="last-name" type="text" placeholder="Doe" class="form-input" />
        </div>
      </div>

      <div class="form-field">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" placeholder="name@example.com" class="form-input" />
      </div>

      <div class="form-field">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" placeholder="Create a strong password" class="form-input" />
      </div>

      <div class="form-field">
        <label for="confirm-password" class="form-label">Confirm password</label>
        <input id="confirm-password" type="password" placeholder="Repeat your password" class="form-input" />
      </div>

      <div class="info-note">
        By creating an account you agree to our terms of service and privacy policy.
      </div>

      <button type="submit" class="form-submit">
        Sign Up
      </button>
    </form>

    <p class="form-footer">
      Already have an account?
      <NuxtLink to="/login">
        Log in instead
      </NuxtLink>
    </p>
  </section>
</template>
