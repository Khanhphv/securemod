<template>
    <div class="container-scroller">
        <div class="login">
            <div class="login-form">
                <h1 class="text-center">Register
                  <br/>
                </h1>
                <div class="entry__info">
                  <form @submit="">
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Email</label
                      >
                      <input
                          v-model="email"
                          type="email"
                          class="form-control field-input"
                          id="exampleFormControlInput1"
                          placeholder="name@example.com"
                      />
                    </div>
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Password</label
                      >
                      <input
                          v-model="password"
                          type="password"
                          class="form-control"
                          placeholder="password"
                      />
                    </div>
                    <p class="text-end text-xs text-primary">
                      <router-link to="/register">Register</router-link>
                    </p>
                    <button
                        @click="NormalLogin"
                        type="button"
                        class="mb-3 btn btn-outline-primary btn-full-width button-border-radius"
                    >
                      Login
                    </button>
                    <button
                        @click="LoginWithGoogle"
                        type="button"
                        class="btn btn-primary btn-full-width button-border-radius"
                    >
                      Sign in with Google
                    </button>
                  </form>
                </div>
                <div class="entry__top"></div>

            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>

<script>
export default {
name: "Register"
}
</script>

<style scoped>

</style>
