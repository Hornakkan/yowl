<script setup>
import { RouterLink, RouterView } from 'vue-router'
import UserLogin from './components/UserLogin.vue'
import Logo from './components/Logo.vue'
import FooterView from './views/FooterView.vue'
</script>

<template>
  <nav>
    <Logo />
    <UserLogin />
  </nav>
  
    <RouterView />
  
  
  <FooterView />
</template>
