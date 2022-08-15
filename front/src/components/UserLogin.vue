<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <div class="user-wrapper">
        <div class="user">
            <input type="text" v-if="!logged" name="user--email" id="user--email" class="user--email" v-model="email" placeholder="your email...">
            <input type="password" v-if="!logged" name="user--password" id="user--password" class="user--password" v-model="password">
            <input type="checkbox" v-if="!logged" name="user--remember" id="user--remember" class="user--remember" v-model="remember">
            <label for="user--remember" v-if="!logged">remember me</label>
            <button v-if="!logged" class="user--login" @click="login">Login</button>
            <RouterLink to='/register' class="user--a">
                <button v-if="!logged" class="user--register" @click="">Register</button>
            </RouterLink>
            <p v-if="logged" class="user--greetings">Welcome {{ user.name }}</p>
            <button v-if="logged" class="user--logout" @click="logout">Logout</button>
            <button v-if="logged" class="user--login" @click="profile">My profile</button>
            <RouterLink to='/admin'>
                <button v-if="user.admin" class="user--admin">Admin page</button>
            </RouterLink>
        </div>
        <div class="user--forgot" v-if="forgot">
            <RouterLink to='/forgot' class="user--a" @click="forgot_toggle">
                <p>Forgot password ?</p>
            </RouterLink>
        </div>
        <div class="warning">
            <p class="warning--message"></p>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        if (localStorage.getItem('user') || sessionStorage.getItem('user')) {
            this.logged  =true
            localStorage.getItem('user') ? this.user = JSON.parse(localStorage.getItem('user')) : this.user = JSON.parse(sessionStorage.getItem('user'))
        }
    },
    data() {
        return {
            email: '',
            password: '',
            remember: true,
            user: '',
            logged: false,
            forgot: false
        }
    },
    methods: {
        forgot_toggle() {
            this.forgot = false
            this.email = ''
            this.password = ''
        },
        warning(message) {
            document.querySelector('.warning--message').innerText = message
            setTimeout(() => {
                document.querySelector('.warning--message').innerText = ""
            }, 3000)
        },
        profile() {
            window.location.href = '/profile'
        },
        login() {
            if (this.username == '' || this.password == '' ) {
                this.warning("Username and Password can't be empty")
            } else {
                   let url = 'http://127.0.0.1:8000/api/login';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                            },
                        body: JSON.stringify({
                            'email': this.email,
                            'password': this.password
                        })
                    })
                    .then(response => {
                        if(response.status == 200) {
                            this.forgot = false
                            return response.json();
                        } else {
                            this.warning("Bad credentials")
                            this.forgot = true
                        }
                    })
                    .then(data => {
                        if(data) {
                            if(this.remember) {
                                localStorage.setItem('user', JSON.stringify(data.user))
                                localStorage.setItem('token', data.token)
                                this.user = JSON.parse(localStorage.getItem('user'))
                                this.logged = !this.logged
                            } else {
                                sessionStorage.setItem('user', JSON.stringify(data.user))
                                sessionStorage.setItem('token', data.token)
                                this.user = JSON.parse(sessionStorage.getItem('user'))
                                this.logged = !this.logged
                            }
                            this.email = ''
                            this.password = ''
                            this.remember = true
                            window.location.href = '/'
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    })
            }
        },
        logout() {
            this.logged = !this.logged
            this.email = ''
            this.password = ''
            if(sessionStorage.getItem('user')) {
                sessionStorage.removeItem('user')
                sessionStorage.removeItem('token')
            } else {
                localStorage.removeItem('user')
                localStorage.removeItem('token')
            }
            window.location.href = '/'
        }
    }
}
</script>