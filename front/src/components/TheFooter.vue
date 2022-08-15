<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Footer -->
    <div class="footer--wrapper">
      <!-- Section: Social media -->
        <section class="footer--social">
          <!-- Facebook -->
          <a class="footer--social--link" href="#!" role="button" aria-label="social media link"><i class="devicon-facebook-plain"></i></a>
          <!-- Twitter -->
          <a class="footer--social--link" href="#!" role="button" aria-label="social media link"><i class="devicon-twitter-original"></i></a>
          <!-- Discord -->
          <a class="footer--social--link" href="#!" role="button" aria-label="social media link"><i id="discord" class="bi bi-discord"></i></a>
          <!-- Linkedin -->
          <a class="footer--social--link" href="#!" role="button" aria-label="social media link"><i class="devicon-linkedin-plain"></i></a>
          <!-- Github -->
          <a class="footer--social--link" href="#!" role="button" aria-label="social media link"><i class="devicon-github-original-wordmark"></i></a>
        </section>
        <!-- Section: Social media -->
        <!-- Section: Form -->
        <section v-if="!registered" class="footer--newsletter"> 
          <strong>Sign up for our newsletter</strong>
          <input class="footer--newsletter--email" type="email" name="email" id="email" placeholder="enter your email adress" v-model="email">
          <button class="footer--newsletter--subscribe" @click="newsletter"> Subscribe </button>
        </section>
        <section v-if="registered" class="footer--newsletter--registered"> 
          <p class="footer--newsletter--registered--message">
            You're now signed in for ou newsletter with {{ email }}, check your e-mail inbox for great news in the next few days ...
          </p>
        </section>
        <!-- <section class="footer--disclaimer">
            <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
            distinctio earum repellat quaerat voluptatibus placeat nam,
            commodi optio pariatur est quia magnam eum harum corrupti
            dicta, aliquam sequi voluptate quas.
            </p>
        </section> -->
        <section>
          <div class="footer--links">
            <ul><li><RouterLink to='/about' class="footer--a">About us</RouterLink></li></ul>
            <ul><li><RouterLink to='/apidoc' class="footer--a">API doc</RouterLink></li></ul>
            <ul><li><a href="#">Privacy notice</a></li></ul>
          </div>
        </section>
        <!-- Copyright -->
        <div class="footer--copyright">
            © 2022 Copyright: <RouterLink to='/about' class="footer--a">Team Error 418</RouterLink>
        </div>
    </div>
  <!-- Footer -->
</template>

<script>
export default {
  data() {
    return {
      registered: false,
      email: ''
    }
  },
  methods: {
    validateEmail (email) {
        let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return regex.test(email)
    },    
    newsletter() {
      if (this.email && this.validateEmail(this.email)) {
        this.registered = !this.registered
      }
    }
  }
}
</script>