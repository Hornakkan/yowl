<script setup>
    import { RouterLink, RouterView, useRoute } from 'vue-router'
</script>

<template>
    <div class="profile-wrapper">
        <p class="profile--title">Profile page</p>
        <div class="warning--message"></div>
        <div class="success--message"></div>
        <div class="profile" v-if="logged">
            <p>
                <label for="name">User name</label>
                <input type="text" class="profile--name" name="name" id="name" v-model="name" required>
            </p>
            <p>
                <label for="email">E-mail</label>
                <input type="email" class="profile--email" name="email" id="email" v-model="email" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" class="profile--password" name="password" id="password" v-model="password">
            </p>
            <p>
                <span class="profile--password--instructions">at least 8 characters long</span>
            </p>
            <p>
                <label for="birthdate">Birth date</label>
                <input type="date" name="birthdate" id="birthdate" v-model="birthdate">            
            </p>
            <p class="profile--buttons">
                <button v-if="!delbutton" class="profile--submit" @click="update">Update profile</button>
                <button v-if="!delbutton" class="profile--delete" @click="initdel">Delete profile</button>
                <span v-if="delbutton" class="profile--delete-confirm">You're about to delete your profile, are you sure ?</span>
                <button v-if="delbutton" class="profile--delete" @click="destroy">Confirm</button>
            </p>
        </div>
        <RouterLink to='/' class="user--a">
            <button class="profile--back" @click="">Back</button>
        </RouterLink>
    </div>
</template>

<script>
export default {
    mounted() {
        // const route = useRoute();
        //console.log(route.params.id);
        this.getUser();
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            birthdate: '',
            userid: '',
            token: '',
            logged: false,
            delbutton: false
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
        initdel() {
            this.delbutton = !this.delbutton
        },
        getUser() {
            if (localStorage.getItem('token') && localStorage.getItem('user')) {
                this.userid = JSON.parse(localStorage.getItem('user')).id
                this.name = JSON.parse(localStorage.getItem('user')).name
                this.email = JSON.parse(localStorage.getItem('user')).email
                this.birthdate = JSON.parse(localStorage.getItem('user')).birthdate
                this.token = localStorage.getItem('token')
                this.logged = true
            }
            if (sessionStorage.getItem('token') && sessionStorage.getItem('user')) {
                this.name = JSON.parse(sessionStorage.getItem('user')).name
                this.userid = JSON.parse(sessionStorage.getItem('user')).id
                this.email = JSON.parse(sessionStorage.getItem('user')).email
                this.birthdate = JSON.parse(sessionStorage.getItem('user')).birthdate
                this.token = sessionStorage.getItem('token')
                this.logged = true
            }
        },
        validateEmail (email) {
            let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return regex.test(email)
        },
        validatePwd(password) {
            // let regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/
            let regex = /^([a-zA-Z0-9]{8,})$/
            if (password == '') {
                return true
            } else {
                return regex.test(password)
            }
        },
        checkdata() {
            if(this.name == '' || this.email == '' ) {
                this.warning("User name and email can't be empty")
                setTimeout(() => {
                    this.getUser()
                    return false
                }, 3000)
            } else if (!this.validateEmail(this.email)) {
                this.warning("Syntax error in email field")
                setTimeout(() => {
                    this.getUser()
                    return false
                }, 3000)                
            } else if(!this.validatePwd(this.password)) {
                this.warning("Password must be : at least 8 characters long")
                setTimeout(() => {
                    this.getUser()
                    return false
                }, 3000)   
            } else {
                return true
            }
        },
        update() {
            if(this.checkdata()) {
                let url = 'http://127.0.0.1:8000/api/users/' + this.userid;
                let myBody
                if (this.password != '') {
                    myBody = JSON.stringify({
                        'name': this.name,
                        'email': this.email,
                        'password': this.password,
                        'birthdate': this.birthdate
                        }) 
                } else {
                    myBody = JSON.stringify({
                        'name': this.name,
                        'email': this.email,
                        'birthdate': this.birthdate
                        }) 
                }

                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${this.token}`
                        },
                    body: myBody
                })
                .then(() => {
                    this.password = ''
                    if (localStorage.getItem('user')) {
                        let user = JSON.parse(localStorage.getItem('user'))
                        user.name = this.name
                        user.email = this.email
                        user.birthdate = this.birthdate        
                        localStorage.setItem('user', JSON.stringify(user))                    
                    } else if (sessionStorage.getItem('user')) {
                        let user = JSON.parse(sessionStorage.getItem('user'))
                        user.name = this.name
                        user.email = this.email
                        user.birthdate = this.birthdate
                        sessionStorage.setItem('user', JSON.stringify(user))
                    }
                })
                .then( () => {
                    this.success("Your profile has been updated")
                })
                .catch(error => {
                    console.error(error);
                })
            }
        },
        destroy() {
            let url = 'http://127.0.0.1:8000/api/users/' + this.userid;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    }
            })
            .then(() => {
                if(sessionStorage.getItem('user')) {
                    sessionStorage.removeItem('user')
                    sessionStorage.removeItem('token')
                } else {
                    localStorage.removeItem('user')
                    localStorage.removeItem('token')
                }
            })
            .then(() => {
                window.location.href = '/'
            })
            .catch(error => {
                console.error(error);
            })            
        }
    }
}
</script>