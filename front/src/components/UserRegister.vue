<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <div class="register-wrapper">
        <p class="register--title" v-if="!register_success">Registration form</p>
        <p class="register--subtitle" v-if="!register_success">fields marked with * are mandatory</p>
        <div class="warning--message"></div>
        <div class="success--message"></div>
        <div class="register" v-if="!register_success">
            <p>
                <label for="name">User name</label>
                <input type="text" class="register--name" name="name" id="name" v-model="name" required>
                <span class="register--error">{{ name_error }}</span>
            </p>
            <p>
                <label for="email">E-mail</label>
                <input type="email" class="register--email" name="email" id="email" v-model="email" required>
                <span class="register--error">{{ email_error }}</span>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" class="register--password" name="password" id="password" v-model="password" required>
                <span class="register--error">{{ password_error }}</span>
            </p>
            <p>
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" class="register--password_confirmation" name="password_confirmation" id="password_confirmation" v-model="password_confirmation" required>
                <span class="register--error">{{ password_confirmation_error }}</span>                
            </p>
            <p>
                <label for="birthdate">Birth date</label>
                <input type="date" name="birthdate" id="birthdate" v-model="birthdate">
                <span class="register--error">{{ birthdate_error }}</span>                
            </p>
            <button class="register--submit" @click="register" >Submit</button>
        </div>
        <RouterLink to='/' class="user--a">
            <button class="register--back" @click="">Back</button>
        </RouterLink>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            name_error: '*',
            email: '',
            email_error: '*',
            password: '',
            password_error: '* (at least 8 characters)',
            password_confirmation: '',
            password_confirmation_error: '*',
            birthdate: '',
            birthdate_error: '',
            register_success: false
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
            this.name = ''
            this.name_error = '*'
            this.email = ''
            this.email_error = '*'
            this.password = ''
            this.password_error = '* (at least 8 characters)'
            this.password_confirmation = ''
            this.password_confirmation_error = '*'
            this.birthdate = ''
            this.birthdate_error = ''
        },
        validateEmail (email) {
            let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return regex.test(email)
        },
        validatePwd(password) {
            // let regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/
            let regex = /^([a-zA-Z0-9]{8,})$/
            return regex.test(password)
        },                
        checkdata() {
            if(this.name == '' || this.password == '' || this.password_confirmation == '' || this.email == '') {
                this.warning("User name, email, password and its confirmation can't be empty")
                setTimeout(() => {
                    return false
                }, 3000)
            } else if (!this.validateEmail(this.email)) {
                this.warning("Syntax error in email field")
                setTimeout(() => {
                    return false
                }, 3000)                
            } else if (!this.validatePwd(this.password) || this.password != this.password_confirmation) {
                this.warning("Syntax error in password and/or password confirmation fields")
                setTimeout(() => {
                    return false
                }, 3000)  
            } else {
                return true
            }
        },        
        register() {
            event.preventDefault();
            if (this.checkdata()) {
                let url = 'http://127.0.0.1:8000/api/register';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                        },
                    body: JSON.stringify({
                        'name': this.name,
                        'email': this.email,
                        'password': this.password,
                        'password_confirmation': this.password_confirmation,
                        'admin': 0,
                        'birthdate': this.birthdate
                    })
                })
                .then(response => {
                        return response.json();
                })
                .then(data => {
                    if(data.errors) {
                        this.warning(data.message)
                        data.errors.name ? this.name_error =  data.errors.name[0] : this.name_error = ''
                        data.errors.email ? this.email_error =  data.errors.email[0] : this.email_error = ''
                        data.errors.password ? this.password_error =  data.errors.password[0] : this.password_error = ''
                    } else {
                        this.register_success = !this.register_success
                        this.resetfields()
                        this.success("Your account has been created with success. Redirecting to the home page ...")
                        setTimeout(() => {
                            window.location.href = '/'
                        }, 3000)
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