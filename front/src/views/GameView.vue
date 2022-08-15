<script setup>
    import { RouterLink, RouterView, useRoute } from 'vue-router'
</script>

<template>
    <div class="w-full px-16">
        <h1 class="text-3xl text-blue-200 mb-4">Games center</h1>
        <label class="block ml-1 mb-1" for="newGame">Add a game</label>
        <input id="newGame" class="mb-4 border-2 h-8" type="text" v-model="newGame">
        <button @click="createGame" class="bg-blue-200 px-3 py-1">Add</button>
        <div class=" grid grid-cols-4 gap-4 text-center mb-4">
        <div v-for="game in games.games"><button class="h-10 w-10 mr-2 bg-red-300 rounded-full" @click="delGame(game.id)">X</button>{{game.id}} - {{game.name}}
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
            chartData: {
                labels: [ 'j-7', 'j-6', 'j-5', 'j-4', 'j-3', 'j-2', 'j-1' ],
                datasets: [ { data: [3, 4, 5, 2, 3, 4, 1] } ]
            },
            chartOptions: {
                responsive: false
            },
            games: [],
            newGame: ""
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
        this.fetchGames()
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
        async fetchGames() {
            const url = 'http://127.0.0.1:8000/api/games'
            this.games = await (await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })).json()
        },
        async delGame(id) {
            const url = 'http://127.0.0.1:8000/api/games/' + id;
            await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })
            await this.fetchGames()
        },
        async createGame() {
            const url = 'http://127.0.0.1:8000/api/games/';
            await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                },
                body: JSON.stringify({
                    name: this.newGame
                })
            })
            await this.fetchGames()
            this.newGame = ''
        },
        async fetchReviews() {
            const url = 'http://127.0.0.1:8000/api/reviews'
            this.reviews = await (await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })).json()
            console.log(this.reviews)
        }
    }
}
</script>