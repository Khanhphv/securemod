<template>
    <div class="container-scroller">
        <div class="login">
            <div class="login-form">
                <h1 class="text-center">Register</h1>
                <div class="entry__info">
          Please ensure you are visiting the correct url.
          <br/>
          <b class="text-success">{{ this.url.origin }}</b>
        </div>
                <div class="entry__info">
                  <form @submit.prevent="register">
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Username</label
                      >
                      <input
                          v-model="namereg"
                          type="text"
                          class="form-control field-input"
                          id="exampleFormControlInput1"
                          placeholder="Username"
                      />
                    </div>
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Email</label
                      >
                      <input
                          v-model="emailreg"
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
                          v-model="passwordreg"
                          type="password"
                          class="form-control"
                          placeholder="Password"
                      />
                    </div>
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Confirm password</label
                      >
                      <input
                          v-model="confirmpassword"
                          type="password"
                          class="form-control"
                          placeholder="Confirm password"
                      />
                    </div>
                    <div class="mb-3">
                      <label
                          for="exampleFormControlInput1"
                          class="form-label text-xs fw-bold text-secondary"
                      >Ref code</label
                      >
                      <input
                          v-model="refcode"
                          type="text"
                          class="form-control"
                          placeholder="Ref. code"
                      />
                    </div>
                    <div class="text-center">
                      <vue-recaptcha  
                      style="display: inline-block;" 
                      theme="dark" 
                      @verify="callbackre" 
                      sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI">
                        
                      </vue-recaptcha>
                    </div>
                    <hr>
                    <button
                        @click="register"
                        type="button"
                        class="mb-3 btn btn-outline-primary btn-full-width button-border-radius"
                    >
                      Register
                    </button>
                  </form>
                </div>
                
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>

<script>
import Vue from 'vue';
import { VueRecaptcha } from 'vue-recaptcha';
import axios from "axios";
import Swal from "sweetalert2";

export default {
  mounted() {
    console.log("Component loaded.");
    console.log("url", this.url);
  },
  components: { VueRecaptcha },
  data() {
    return {
      namereg: null,
      emailreg: null,
      passwordreg: null,
      confirmpassword: null,
      refcode: null,
      isLoading: false,
      fullPage: true,
      recaptchaVerified: false,
      color: "#4540f7",
      url: window.location
    };
  },
  methods:{
    callbackre: function(response) {
      this.recaptchaVerified = true;
    },
    register: function(){
      if (!this.recaptchaVerified) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Please complete the captcha",
        });
        return true;
      }
      axios
        .post(
          "/customer_register",
          {
              name: this.namereg,
              email: this.emailreg,
              password: this.passwordreg,
              repassword: this.confirmpassword,
              refcode: this.refcode
          },
          {responseType: "json"}
        )
        .then(function (response) {
          window.location.href = "/login";
          return Swal.fire({
            icon: "success",
            title: "Success",
            text: "Registered successfully!",
          });
        })
        .catch(function (error) {
          let response_error = error.response.data.errors.email[0];
          return Swal.fire({
            icon: "error",
            title: "Register Failed",
            text: response_error,
          });
        });
      
    }
  }
};
</script>

<style scoped>

</style>
