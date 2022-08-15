<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <div class="forgot-wrapper">
        <p class="forgot--title">Forgot password form</p>
        <div class="warning--message"></div>
        <div class="success--message"></div>
        <div class="forgot">
            <p>
                <label for="email">E-mail</label>
                <input type="email" class="forgot--email" name="email" id="email" v-model="email" required>
            </p>
            <button class="forgot--submit" @click="sendmail" >Submit</button>
        </div>
        <RouterLink to='/' class="user--a">
            <button class="forgot--back" @click="">Back</button>
        </RouterLink>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            email_error: '*',
            forgot_success: false
        }
    },
    methods: {
        warning(message) {
            document.querySelector('.warning--message').innerText = message
            setTimeout(() => {
                document.querySelector('.warning--message').innerText = ""
            }, 3000)
        },
        success(message) {
            document.querySelector('.success--message').innerText = message
            setTimeout(() => {
                document.querySelector('.success--message').innerText = ""
                window.location.href = '/'
                // window.location.reload()
            }, 3000)
        },        
        resetfields() {
            this.email = ''
        },
        validateEmail (email) {
            let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return regex.test(email)
        },        
        checkdata() {
            if(this.email == '') {
                this.warning("Email can't be empty")
                setTimeout(() => {
                    return false
                }, 3000)
            } else if (!this.validateEmail(this.email)) {
                this.warning("Syntax error in email field")
                setTimeout(() => {
                    return false
                }, 3000)                
            } else {
                return true
            }
        },        
        sendmail() {
            if (this.checkdata()) {
                let url = 'http://127.0.0.1:8000/api/password/email';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                    body: JSON.stringify({
                        'email': this.email,
                    })
                })
                .then(response => {
                        return response.json()
                })
                .then(data => {
                    if(data.error) {
                        this.warning(data.error)
                    } else {
                        this.success(data.message)
                    }
                })
                .catch(error => {
                    console.error(error);
                })
            }
        }
    }
}
</script>