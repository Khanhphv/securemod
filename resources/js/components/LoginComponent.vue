<template>
  <div class="container-scroller">
    <div class="login">
      <div class="login-form">
        <h1 class="text-center">Sign in</h1>
        <div class="entry__info">
          Please ensure you are visiting the correct url.
          <br/>
          <b class="text-success">{{ this.url.origin }}</b>
        </div>
        <div class="entry__top"></div>
        <form @submit="NormalLogin">
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
              id="exampleFormControlInput1"
              placeholder="password"
            />
          </div>
          <p class="text-end text-xs text-primary"><a href="">Forgot password?</a></p>
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
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  mounted() {
    console.log("Component loaded.");
    console.log("url", this.url);
  },
  components: {
    // Loading
  },
  props: [
    "logo_url",
    "login_via_facebook",
    "login_via_google",
    "login_via_discord",
  ],
  data: function () {
    return {
      email: null,
      password: null,
      isLoading: false,
      fullPage: true,
      color: "#4540f7",
      url: window.location
    };
  },
  methods: {
    LoginWithFB: function () {
      window.location.href = this.login_via_facebook;
    },
    LoginWithDiscord: function () {
      window.location.href = this.login_via_discord;
    },
    LoginWithGoogle: function () { 
      window.location.href = this.login_via_google;
    },
    NormalLogin: function () {
      axios
        .post(
          "/customer_login",
          {
            email: this.email,
            password: this.password,
            remember: "on",
          },
          { responseType: "json" }
        )
        .then(function (response) {
          window.location.href = "/";
          return Swal.fire({
            icon: "success",
            title: "Success",
            text: "Login Successfully",
          });
        })
        .catch(function (error) {
          let response_error = error.response.data.errors.email[0];
          return Swal.fire({
            icon: "error",
            title: "Login Failed",
            text: response_error,
          });
        });
    },
  },
};
</script>
