<template>
    <div class="flex flex-row justify-around">
        <p class="text-white">Filter by game:
            <select class="text-black" v-model="gameId" @change="emitFilterGame">
                <option selected value="">Choose</option>
                <option v-for="game in games" :value="game.id">{{game.name}}</option>
            </select>
        </p>
        <p class="text-white">Order by:
            <select class="text-black" v-model="order" @change="emitOrderReview">
                <option selected value="">Choose</option>
                <option value="date_desc">Newer review</option>
                <option value="date_asc">Older review</option>
                <option value="comments_desc">Most comments</option>
                <option value="comments_asc">Least comments</option>
                <option value="rank_desc">Best rating</option>
                <option value="rank_asc">Worst rating</option>
            </select>
        </p>
    </div>
</template>
<script>
export default {
    props: ['gameId', 'order'],
    mounted() {
        this.getGames()
    },    
    data(){
        return {
            games: []
        }
    },
    methods:{
      async getGames() {
        let res = await fetch("http://localhost:8000/api/games");
        let data = await res.json();
        this.games = data.games
      },
      emitFilterGame() {
        this.$emit('filterGames', this.gameId)
      },
      emitOrderReview() {
        this.$emit('orderReview', this.order)
      }
    }
}
</script>