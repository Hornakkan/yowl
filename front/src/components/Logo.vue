<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
<div class="logo--wrapper">
    <RouterLink to='/' class="logo--a">
        <img :src="'../../'+logo" class="logo--img" aria-label="web site logo">
    </RouterLink>
</div>
</template>

<script>
export default {
    data () {
        return {
            // logo: 'naruto.png'
            logo: 'neon.png'
            // logo: 'roadrage.png'
        }
    }
}
</script>