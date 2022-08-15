<script setup>
    import { RouterLink, RouterView, useRoute } from 'vue-router'
</script>

<template>
    <div class="w-full px-16">
        <h1 class="text-3xl text-blue-200 mb-4">Users center</h1>
        <RouterLink to='/register' class="">
            <button class="bg-blue-300 px-3 py-1 rounded-lg my-4" @click="">Add a user</button>
        </RouterLink>
        <div class=" grid grid-cols-1 gap-4 text-center mb-4">
        <div v-for="user in users.users">
        <div><input :name="'name' + user.id" class="mx-1 p-1" type="text" v-model="user.name"><input :name="'email' + user.id" class="mx-1 p-1" type="text" v-model="user.email"><button class="px-3 py-1 ml-2 bg-blue-300 rounded-lg" @click="updateUser(user.id)">update</button><button class="h-10 w-10 ml-2 bg-red-300 rounded-full" @click="delUser(user.id)">X</button></div>
        </div>
    </div>
    </div>
    
    <RouterLink to='/admin' class="user--a">
        <button class="profile--back" @click="">Back</button>
    </RouterLink>
</template>

<script>
export default {
    
    data() {
        return {
            name: '',
            email: '',
            password: '',
            birthdate: '',
            userid: '',
            token: '',
            user: "",
            users: "",
            newUser: ""
        }
    },
    created() {
        if (localStorage.getItem('user') || sessionStorage.getItem('user')) {
            localStorage.getItem('user') ? this.user = JSON.parse(localStorage.getItem('user')) : this.user = JSON.parse(sessionStorage.getItem('user'))
            if(!this.user.admin) {
                window.location.href = ('/')
            }
        } else {
            window.location.href = ('/')
        }
        this.getUser(),
        this.fetchUsers()
    },
    methods: {
        async getUser() {
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
        async fetchUsers() {
            const url = 'http://127.0.0.1:8000/api/users'
            this.users = await (await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })).json()
        },
        async delUser(id) {
            const url = 'http://127.0.0.1:8000/api/users/' + id;
            await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })
            await this.fetchUsers()
        },
        async createUser() {
            const url = 'http://127.0.0.1:8000/api/users/';
            await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                },
                body: JSON.stringify({
                    name: this.newUser
                })
            })
            await this.fetchUsers()
            this.newUser = ''
        },
        async updateUser(id) {
            const url = 'http://127.0.0.1:8000/api/users/' + id
            let nameRef = "name" + id
            let emailRef = "email" + id
            let newName = document.querySelector("[name=" + nameRef + "]")
            let newEmail = document.querySelector("[name=" + emailRef + "]")
            await fetch(url, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                },
                body: JSON.stringify({
                    name: newName.value,
                    email: newEmail.value
                })
            })
            await this.fetchUsers()
        }
    }
}
</script>