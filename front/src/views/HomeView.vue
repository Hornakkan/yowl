<template>
  <main >
    <span class="searchfilterbar">
    <SearchBar @searchReview="sendSearch" :query="query"/>
    <FilterGames @filterGames="sendFilter" @orderReview="sendOrder" :gameId="gameId" :order="order" />
    </span>
    <CarrouselImage v-if="!isSearching"/>
    <div id="homeView" class="flex flex-col">
      <div class="m-2">
        <button
                v-if="isSearching"
                type="button"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                @click="backHome">
          Back Home
        </button>
        <button 
                v-if="logged"
                type="button"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                @click="addReview()"><i class="bi bi-send-plus"></i> review
        </button>
      </div>
      <div class="w-screen h-screen bg-gray-600 flex row flex-wrap">
        <div v-for="review in allReview" :key="review.id" class=" m-5" >
          <div class="bg-gray-900 rounded-xl " @click="myReview(review.id)">
            <Review
            :id="review.id"
            :title="review.title"
            :picture="review.picture"
            :content="review.content"
            :updated_at="review.updated_at"
            :review_rank="review.review_rank"
            />
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import Review from '../components/Review.vue';
import CarrouselImage from '../components/CarrouselImage.vue';
import SearchBar from '@/components/SearchBar.vue'
import FilterGames from '@/components/FilterGames.vue'

export default {
  name: "HomeView",
  components: {
    Review,
    SearchBar,
    FilterGames,
    CarrouselImage
  },
  mounted() {
      if (localStorage.getItem('user') || sessionStorage.getItem('user')) {
          this.logged = true
          localStorage.getItem('user') ? this.user = JSON.parse(localStorage.getItem('user')) : this.user = JSON.parse(sessionStorage.getItem('user'))
      }
      if (localStorage.getItem('token')) {
          this.token = localStorage.getItem('token')
      }
      if (sessionStorage.getItem('token')) {
          this.token = sessionStorage.getItem('token')
      }
    this.fetchReview();         
  },     
  data(){
    return {
      allReview : [],
      user: '',
      token: '',
      logged: false,
      isSearching: false,
      query: "",
      gameId: "",
      order: ""
    }
  },
  methods:{
    fetchReview(){
      var myHeaders = new Headers();
      myHeaders.append("Cookie", "XSRF-TOKEN=eyJpdiI6ImQ3TFQyUkJTTGUxaEZiNjQ1a0FoUlE9PSIsInZhbHVlIjoiS01KN204N2Q2YkNNZnBpVFllV1ZvUDN0WkZLV0JLY0pDUnIyejZQZ2V3SkhZYXBYQy80QUt6RWxRVllDSVhxczVGbGVVR2RDbTgvQ0pmYlhEdUxsYzFHY0x6MEY1MEw0Qk12aGlzKzM4NHJHZWJOOTI1WWRGSksrdWZNQUFGR0IiLCJtYWMiOiI0OWMyNTJlYWRkOGU3ZTM1OWZmMDkwOGVjMzc5M2ZkNzc0NTlkNzUxMDViYzFkYTlmMDZhYjAyODM3NDAzNDYyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlhLekZTWms3TjB0U0doajFjcXJIaVE9PSIsInZhbHVlIjoiUUYvU1hnRis1UWZrWjB1Q3dPVUJqTDNlTTlNVW9YYmVJbmwrZWllbEpIRDZveXI5RGNvQzhzOG1Id3FrcVhpZ3M0cHloZC9FYzRJa09PWTEya1FlYnRmZnhTY1NDWC93ZURNelhiNnhLVWJ6QjZ3ZXluTXBMZGNzNkhBeGtKLzUiLCJtYWMiOiIwM2ZmZDRiYmEzYzVhNGQ0NDM1YmI2ZGMzMGNiNTUzMWZlZDU5MDA5YjFhOWNkNzFmNGQ1ZDRjOGU1NTAxNDU0IiwidGFnIjoiIn0%3D");  

      var requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
      };

      fetch("http://127.0.0.1:8000/api/reviews", requestOptions)
      .then(response => response.json())
      .then(result => (this.allReview = result))
      .catch(error => console.log('error', error));
    },
    myReview(id){
      this.$router.push(`/review/${id}`);
    },
    addReview(){
      this.$router.push(`/NewReview`);
    },
    sendSearch(query) {
      this.search(query, this.gameId, this.order)
    },
    sendFilter(gameId) {
      this.search(this.query, gameId, this.order)
    },
    sendOrder(order) {
      this.search(this.query, this.gameId, order)
    },
    async search(query, gameId, order){
      if (query == "" && gameId == "" && order == ""){
        return this.backHome();
      }
      this.query = query
      this.gameId = gameId
      this.order = order
      let url = "http://localhost:8000/api/search/"
      let key = '?'

      if (query != "") {
        url += `${key}query=${query}`
        key = '&'
      }
      if (gameId != "") {
        url += `${key}gameId=${gameId}`
        key = '&'
      }
      if (order != "") {
        url += `${key}order=${order}`
        key = '&'
      }

      let res = await fetch(url);
      let data = await res.json();
      this.allReview = data;
      this.isSearching = true;
    },
    backHome(){
      this.fetchReview();
      this.query = "";
      this.gameId = "";
      this.order = "";
      this.isSearching = false;
    }
  }

}
</script>
