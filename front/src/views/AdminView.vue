<script setup>
    import { Bar } from 'vue-chartjs'
    import { RouterLink, RouterView, useRoute } from 'vue-router'
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
</script>
<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
export default {
    name: 'BarChart',
    components: { Bar },
    props: {
        chartId: {
        type: String,
        default: 'bar-chart'
        },
        datasetIdKey: {
        type: String,
        default: 'label'
        },
        width: {
        type: Number,
        default: 400
        },
        height: {
        type: Number,
        default: 400
        },
        cssClasses: {
        default: '',
        type: String
        },
        styles: {
        type: Object,
        default: () => {}
        },
        plugins: {
        type: Object,
        default: () => {}
        }
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            birthdate: '',
            userid: '',
            token: '',
            admin: false,
            chartData: {
                labels: [],
                datasets: [ {
                    label: 'Nombre de reviews des 5 derniers jeux',
                    backgroundColor: '#f87979',
                    data: [3, 4, 5, 2, 3, 4, 1],
                }]
            },
            chartOptions: {
                responsive: false
            },
            users: [],
            reviews: [],
            games: [],
            comments: []
        }
    },
    computed: {
        labels() {
            return this.chartData.labels
        }
    },
    mounted() {
        this.getUser()
        if (!this.admin) {
            window.location.href = '/'
        }
        this.fetchUsers()
        this.fetchReviews()
        this.fetchGames()
        this.fetchComments()
    },
    watch: {
        games(newGame, old) {
            let result = []
            if(newGame.games.length > 4) {
                for (let i = newGame.games.length - 5; i < newGame.games.length; i++) {
                    result.push(newGame.games[i].name);
                }
                this.chartData.labels = result
            } else {
                for (let i = 0; i < newGame.games.length; i++) {
                    result.push(newGame.games[i].name);
                }
                this.chartData.labels = result
            }
        },
        reviews() {
            let id_array = []
            if(this.games.games.length > 4) {
                for (let i = this.games.games.length - 5; i < this.games.games.length; i++) {
                    id_array.push(this.games.games[i].id);
                }
                let data = []
                for (let i = 0; i < id_array.length; i++) {
                    let review_nb_for_game = this.reviews.filter(element => element.game_id == id_array[i]).length
                    data.push(review_nb_for_game)
                }
                this.chartData.datasets = [ {
                    label: 'Nombre de reviews',
                    backgroundColor: '#f87979',
                    data: data
                }]
            } else {
                for (let i = 0; i < this.games.games.length; i++) {
                    id_array.push(this.games.games[i].id);
                }
                let data = []
                for (let i = 0; i < id_array.length; i++) {
                    let review_nb_for_game = this.reviews.filter(element => element.game_id == id_array[i]).length
                    data.push(review_nb_for_game)
                }
                this.chartData.datasets = [ {
                    label: 'Nombre de reviews',
                    backgroundColor: '#f87979',
                    data: data
                }]                
            }
        }
    },
    methods: {
        async getUser() {
            if (localStorage.getItem('token') && localStorage.getItem('user')) {
                this.userid = JSON.parse(localStorage.getItem('user')).id
                this.name = JSON.parse(localStorage.getItem('user')).name
                this.email = JSON.parse(localStorage.getItem('user')).email
                this.birthdate = JSON.parse(localStorage.getItem('user')).birthdate
                this.admin = JSON.parse(localStorage.getItem('user')).admin
                this.token = localStorage.getItem('token')
                this.logged = true
            }
            if (sessionStorage.getItem('token') && sessionStorage.getItem('user')) {
                this.name = JSON.parse(sessionStorage.getItem('user')).name
                this.userid = JSON.parse(sessionStorage.getItem('user')).id
                this.email = JSON.parse(sessionStorage.getItem('user')).email
                this.birthdate = JSON.parse(sessionStorage.getItem('user')).birthdate
                this.admin = JSON.parse(sessionStorage.getItem('user')).admin
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
        },
        async fetchGames() {
            const url = 'http://127.0.0.1:8000/api/games'
            this.games = await (await fetch(url)).json()
        },
        async fetchComments() {
            const url = 'http://127.0.0.1:8000/api/comments'
            this.comments = await (await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                    },
            })).json()
        }
    }
}
</script>
<template>
    <div class="w-full px-16">
        <h1 class="text-3xl text-blue-200 mb-4">Admin center</h1>
        <h2 class="text-xl ml-10">KPI</h2>
        <div class="flex grow">
                <Bar class="my-5 m-auto"
        :chart-options="chartOptions"
        :chart-data="chartData"
        :chart-id="chartId"
        :dataset-id-key="datasetIdKey"
        :plugins="plugins"
        :css-classes="cssClasses"
        :styles="styles"
        :width="width"
        :height="height"
    />
            </div>
        <div class=" grid grid-cols-2 gap-4 content-center">
            <div class="h-48 flex flex-col">
                <div v-if="users.users" class="flex h-3/4 m-auto items-center text-8xl">{{users.users.length}}</div>
                <div class="flex h-1/4 text-lg m-auto font-bold items-center">Nombre d'utilisateurs inscrits</div>
            </div>
            <div class="h-48 flex flex-col">
                <div class="flex h-3/4 m-auto items-center text-8xl">{{reviews.length}}</div>
                <div class="flex h-1/4 text-lg m-auto font-bold items-center">Nombre de reviews</div>
            </div>
            <div class="h-48 flex flex-col">
                <div v-if="games.games" class="flex h-3/4 m-auto items-center text-8xl">{{games.games.length}}</div>
                <div class="flex h-1/4 text-lg m-auto font-bold items-center">Nombre de games</div>
            </div>
            <div class="h-48 flex flex-col">
                <div v-if="this.comments.success" class="flex h-3/4 m-auto items-center text-8xl">{{comments.success.length}}</div>
                <div class="flex h-1/4 text-lg m-auto font-bold items-center">Nombre de comments</div>
            </div>
        </div>
        <hr class="m-5"/>
        <h2 class="text-xl ml-10">Ressources</h2>
        <div class=" grid grid-cols-2 gap-4 content-center">
            <div class="m-5 flex flex-col items-center">
                <RouterLink to='/games'>
                    <button class="bg-blue-200 p-5 rounded-lg">games</button>
                </RouterLink>
            </div>
            <div class="m-5 flex flex-col items-center">
                <RouterLink to='/users'>
                    <button class="bg-blue-200 p-5 rounded-lg">users</button>
                </RouterLink>
            </div>
            <div class="m-5 flex flex-col items-center">
                <RouterLink to='/'>
                    <button class="bg-blue-200 p-5 rounded-lg">reviews</button>
                </RouterLink>
            </div>
        </div>
    </div>
    <RouterLink to='/' class="user--a">
        <button class="profile--back" @click="">Back</button>
    </RouterLink>
</template>