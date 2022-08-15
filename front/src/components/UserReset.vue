<script setup>
    import { RouterLink, RouterView, useRoute } from 'vue-router'
</script>

<template>
    <div class="reset-wrapper">
        <p class="reset--title">Reset password form</p>
        <div class="warning--message"></div>
        <div class="success--message"></div>
        <div class="reset">
            <p>
                <label for="email">E-mail</label>
                <input type="email" class="reset--email" name="email" id="email" v-model="email" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" class="reset--email" name="password" id="password" v-model="password" required>
            </p>
            <p>
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" class="reset--email" name="password_confirmation" id="password_confirmation" v-model="password_confirmation" required>
            </p>
            <button class="reset--submit" @click="resetpwd" >Submit</button>
        </div>
        <RouterLink to='/' class="user--a">
            <button class="reset--back" @click="">Back</button>
        </RouterLink>
    </div>
</template>

<script>
export default {
    mounted() {
        let route = useRoute()
        this.token = route.query.token
    },    
    data() {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            token: '',
            reset_success: false
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
            if(this.email == '' || this.password == '' || this.password_confirmation == '') {
                this.warning("Email, password and password confirmation can't be empty")
                console.log(this.token);
                setTimeout(() => {
                    return false
                }, 3000)
            } else if (!this.validateEmail(this.email)) {
                this.warning("Syntax error in email field")
                setTimeout(() => {
                    return false
                }, 3000)                
            } else if (this.password != this.password_confirmation) {
                this.warning("The password and its confirmation don't match")
                setTimeout(() => {
                    return false
                }, 3000)  
            } else {
                return true
            }
        },        
        resetpwd() {
            console.log(this.token);
            if (this.checkdata()) {
                let url = 'http://127.0.0.1:8000/api/password/reset';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        },
                    body: JSON.stringify({
                        'email': this.email,
                        'password': this.password,
                        'password_confirmation': this.password_confirmation,
                        'token': this.token
                    })
                })
                .then(response => {
                        return response.json()
                })
                .then(data => {
                    // console.log(data);
                    if(data.errors) {
                        this.warning(data.errors.password[0])
                    } else if (data.error) {
                        this.warning(data.error)
                    } else if (data.message) {
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