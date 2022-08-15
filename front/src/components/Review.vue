<template>
    <div class="column w-80 h-80">
        <h6 class="text-white mx-5 pt-5 text-2xl"> {{ title }}</h6>
        
        <p class="mx-5 mb-1 text-sm text-gray-400 text-xs">Reviewed on <time datetime="2022-01-20 19:00" class="text-gray-400">{{ updated_at.split('T')[0] }} at {{ updated_at.split('T')[1].split('.')[0] }}</time></p>
        <hr class="mx-5">
        <!-- <img class="object-cover w-72 mx-auto my-3 rounded-xl" :src="picture" alt="mon image" > -->
        <img v-if="picture != ''" id="reviewPic" class="object-cover w-72 mx-auto my-3 rounded-xl" :src="'http://127.0.0.1:8000/img/'+picture" alt="review's picture" >
        <div class="flex items-center mx-5 justify-around">
            <div class="flex row">
                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="#FFFF00" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Rating star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <p class="ml-2 text-sm font-bold text-gray-400">{{ review_rank }}</p>
            </div>
            <div class="flex row items-center">
                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                <a href="#" v-if="nbComments == 1" class="text-sm font-medium text-gray-400 underline hover:no-underline">{{ nbComments }} comment</a>
                <a href="#" v-else class="text-sm font-medium text-gray-400 underline hover:no-underline">{{ nbComments }} comments</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"Review",
    props:["id","title","picture","content","updated_at", 'review_rank'],
    mounted() {
        this.getComments(this.id)
    },
    data() {
        return {
            nbComments: 0
        }
    },
    methods: {
        getComments(reviewid) {
            let url = 'http://127.0.0.1:8000/api/reviews/'+reviewid+'/comments'

            fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    }
            })
            .then(response => {
                return response.json()
            })
            .then(data => {
                this.nbComments = data.length
            })
        }
    }
}
</script>