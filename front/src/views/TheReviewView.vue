<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
<div class="w-screen h-screen bg-gray-600">
<div class="column bg-gray-900 w-3/5 mx-auto mt-5 p-5 rounded-xl">
    <h6 class="text-white text-2xl">{{myReview.title }}</h6>
    <h6 class="text-white text-xl">
       {{ displayGame(myReview.game_id)}}
       {{ gameName }}
    </h6>
    <hr>
    <div class="flex mt-2">
        <img v-if="myReview.picture != ''" class="object-cover h-48 w-96" :src="'http://127.0.0.1:8000/img/'+myReview.picture" alt="mon image" >
        <div class="column ml-2 ">
            <p class="text-white indent-8 text-justify"> {{myReview.content}} </p>
        </div>
    </div>
    <div class="flex items-center justify-end mx-2 my-5">
    <svg aria-hidden="true" v-if="myReview.review_rank >= 1" class="w-5 h-5 text-yellow-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    <svg aria-hidden="true" v-if="myReview.review_rank < 1" class="w-5 h-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    
    <svg aria-hidden="true" v-if="myReview.review_rank >= 2" class="w-5 h-5 text-yellow-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    <svg aria-hidden="true" v-if="myReview.review_rank < 2" class="w-5 h-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    
    <svg aria-hidden="true" v-if="myReview.review_rank >= 3" class="w-5 h-5 text-yellow-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    <svg aria-hidden="true" v-if="myReview.review_rank < 3" class="w-5 h-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    
    <svg aria-hidden="true" v-if="myReview.review_rank >= 4" class="w-5 h-5 text-yellow-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    <svg aria-hidden="true" v-if="myReview.review_rank < 4" class="w-5 h-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    
    <svg aria-hidden="true" v-if="myReview.review_rank == 5" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
    <svg aria-hidden="true" v-if="myReview.review_rank < 5" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
</div>
    <!-- rajouter le v-if ( admin == 1 || (author_id == user_id)) -->
    <div v-if="logged" class="m-2 flex row justify-end">
        <button v-if="myReview.author_id == user.id || user.admin == true" class="bg-gray-300 m-2 p-2 rounded" @click="showMyModal(myReview.id,myReview.title,myReview.picture,myReview.content)">Update</button>
        <button v-if="myReview.author_id == user.id || user.admin == true" class="bg-red-800 m-2 p-2 rounded" @click="deleteMyReview(myReview.id)">Delete</button>
    </div>
        <RouterLink to='/' class="user--a">
            <button class="profile--back" @click="">Back</button>
        </RouterLink>
    <div class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <button v-if="user" @click="addComment" type="button" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <i class="bi bi-send-plus"></i> comment
        </button>
        <div id="commentsContainer">
            <Comment v-for="comment in comments" :comment="comment" @updateComment="updateComment" @deleteComment="deleteComment"/>
        </div>
    </div>
</div>
<div v-if="showModal == true">
      <ModalReview
        
        :displayInputA="displayInputA"
        :displayInputB="displayInputB"
        @editReview="editReview"
        @closeMyModal="closeMyModal"
      />
    </div>
</div>
</template>


<script>
import ModalReview from "../components/ModalReview.vue";
import Comment from '../components/Comment.vue';
import { createApp } from 'vue'; // créer un nouvel élément vue

export default {
    name:'theReview',
    components: {
        ModalReview,
        Comment,
    },
    mounted() {
        this.getComments();
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
        this.fetchMyReview(this.$route.params.id);
    },    
    data(){
        return {
            myReview:[],
            showModal: false,
            idToModify: "",
            titleToModify:"",
            contentToModify:"",
            pictureToModify:"",
            user: '',
            owner: '',
            gameName: '',
            token: '',
            logged: false,
            comments: [],
            id: this.$route.params.id
        }
    },
    methods:{
        displayGame(gameId) {
            let url = 'http://127.0.0.1:8000/api/games'

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
                let myGameName = ''
                data.games.forEach(game => {
                    if (game.id == gameId) {
                        this.gameName = game.name
                    }
                });
            })
        },
        displayInputA(inputA) {
        this.titleToModify = inputA;
        },
        displayInputB(inputB) {
        this.contentToModify = inputB;
        },
        closeMyModal() {
        this.showModal = false;
        },
        showMyModal(id,title,picture,content) {
        this.showModal = true;
        this.idToModify = id;
        this.titleToModify = title;
        this.pictureToModify = picture;
        this.contentToModify = content;
        },
        fetchMyReview(id){
           var myHeaders = new Headers();
            myHeaders.append("Cookie", "XSRF-TOKEN=eyJpdiI6IkFoZ1pYelhWd3J2RHBNcy82dVV6N1E9PSIsInZhbHVlIjoiT0ZmeklIZDlKNi9BWmRWYjJBeE5OYitPamxTa1VMNFM5RGNQODBLc2o2SDZ6RnZ5REF2czkwYW9VTS9US0R5NTRFTzFndWVXc0xRMnIrRlpJY1VmQkFkclBTMTZ5Ui9xbFYyc01TZ2t4anRqbncyemd3czRoWkcvUXM1dHdFeVIiLCJtYWMiOiIxMmVlNWVhZjdlZTNlOTE5ZmY0ZjBlZTg2MGY1MjFiMzI3YTdjY2ZkMGMwNzM2MmVmNTYwZGNiOWYxYzg0NjllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InlseXM1cnZoRGU1WnBvcXVLYnNFRnc9PSIsInZhbHVlIjoiaDdNNmRNZEFHSTJxRDZxbzF1UWw3ZFNpMmFtNGtEdmxtM0pvekdBSnZpNWh4QmNIb1QzSTJQU21ENUYrWitCZEpFU3grV081eDQ0SEdyOXdqc3dEZFp3ajNCNGJINjZHaDIwQTVNWEVhVU8ySElPcE5hYzM1MW15Nnp1Y3craHoiLCJtYWMiOiI0YTEzNjUwY2FkZjkyM2Y0NDkzNWQwOTQ0MGM5ODk2YTM2MjAxNTBmODc1ODRhZDM3NDg0MTY5MTRhYWQ3YTU2IiwidGFnIjoiIn0%3D");
            // myHeaders.append('Authorization', 'Bearer ' + this.token)
            myHeaders.append('Accept', 'application/json')
            myHeaders.append('Content-type', 'application/json')

            var requestOptions = {
                method: 'GET',
                headers: myHeaders,
                redirect: 'follow'
            };

            fetch("http://127.0.0.1:8000/api/reviews/"+id, requestOptions)
            .then(response => response.json())
            .then(result => this.myReview=result)
            .catch(error => console.log('error', error));
        },
        editReview() {
        if (this.titleToModify== "" || this.contentToModify=="") {
            //console.log("je peux pas update inputA est vide");
        } else {
        this.showModal = false;

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
        myHeaders.append('Authorization', 'Bearer ' + this.token)
        myHeaders.append('Accept', 'application/json')

        var urlencoded = new URLSearchParams();
        urlencoded.append("title", this.titleToModify);
        urlencoded.append("picture", this.pictureToModify);
        urlencoded.append("content", this.contentToModify);

        var requestOptions = {
        method: 'PUT',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
        };

        fetch("http://127.0.0.1:8000/api/reviews/"+this.idToModify, requestOptions)
        .then(response => response.json())
        .then(result => console.log(result))
        .then(() => this.fetchMyReview(this.idToModify))
        .catch(error => console.log('error', error));

        this.inputA = "";
        this.inputB="";
        }
        },
        deleteMyReview(id){
            var requestOptions = {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${this.token}`
            },
            redirect: 'follow'
            };

            fetch("http://127.0.0.1:8000/api/reviews/"+id, requestOptions)
            .then(response => response.json())
            .then(result => this.backHome())
            .catch(error => console.log('error', error));

        },
        backHome(){
            this.$router.push('/') 
        },
        async getComments() {
            let res = await fetch(
                `http://localhost:8000/api/reviews/${this.id}/comments`
            );
            let data = await res.json();
            this.comments = data.sort((a, b) => b.id - a.id);
        },
        async addComment(){
            var container = document.getElementById('commentsContainer')
            var comments = container.getElementsByClassName('my_comment')
            const tempDiv = document.createElement('div')
            var review = this

            if (comments.length > this.comments.length) {
                return
            }
            var newComment = createApp(Comment, {
                comment: {
                    content:'',
                    author_id : this.user.id,
                    created_at: '',
                    user: {
                        name: this.user.name,
                    }
                },
                isNew: true,
                async onSaveComment(comment_this, comment) {
                    let new_content = comment.content
                    if (new_content === '') {
                        container.removeChild(comment_this.$el)
                        return
                    }
                    await fetch(`http://localhost:8000/api/reviews/${review.id}/comments`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${review.token}`
                        },
                        body: JSON.stringify({
                            author_id: review.user.id,
                            content: new_content,
                        })
                    })
                    await review.getComments()
                    container.removeChild(comment_this.$el)
                }
            }).mount(tempDiv)
            container.prepend(newComment.$el)
        },
        async updateComment(comment){
            var newContent = comment.content

            await fetch(`http://localhost:8000/api/reviews/${this.id}/comments/${comment.id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    'Authorization': `Bearer ${this.token}`
                },
                body: JSON.stringify({
                    author_id: comment.author_id,
                    content: newContent,
                })
            })
            this.getComments()
        },
        async deleteComment(comment){
            await fetch(`http://localhost:8000/api/reviews/${this.id}/comments/${comment.id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.token}`
                }
            })
            this.getComments()
        }
    }

}
</script>