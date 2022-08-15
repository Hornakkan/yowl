<template>
    <div id="newReview" class="relative p-4 w-full max-w-2xl h-full md:h-auto">
      <!-- Modal content -->
      <div class="relative  rounded-lg shadow bg-gray-700">
        <!-- Modal header -->
        <div
          class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600"
        >
          <h3
            class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white"
          >
            Add your review !
          </h3>
          <button
            type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            @click="$emit('closeMyModal')"
          >
          <RouterLink to='/' class="user--a">
            <svg
              class="w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </RouterLink>            
          </button>
        </div>
        <div class="warning">
            <p class="warning--message">
              <span class="warning--review"></span>
            </p>
        </div>        
        <!-- Modal body -->
        <div class="p-6 space-y-6 mx-auto">
          <label for="inputName"></label>
          <input
            type="text"
            ref="inputA"
            class="w-full block px-8 py-3 text-sm font-medium bg-white rounded align-middle"
            placeholder="title ..."
            v-model="inputA"
           
          />
          <textarea
            type="text"
            ref="inputB"
            class="w-full h-48 block px-8 py-3 text-sm font-medium bg-white rounded align-middle"
            placeholder="Content ..."
            v-model="inputB"
          ></textarea>
          <div class="flex flex-col">
            <label for="picture" class="text-white">Choose a picture:</label>
            <input type="file"
            name="picture"
            accept="image/png, image/jpeg" class="text-white"
            v-on:change="onFilePicked">

            <!-- <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="onPickFile">Upload profile picture</button>
            <input
            type="file"
            style="display: none"
            refs="fileInput"
            accept="image/*"
            v-on:change="onFilePicked"/> -->

          </div>
          <div class="flex flex-row">
            <p class="flex items-center justify-end my-5 text-white">Add a rank to this review : </p>
            <div class="flex items-center justify-end mx-2 my-5">
                <svg aria-hidden="true" id='1' @click="setRank(1)" class="w-5 h-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg aria-hidden="true" id='2' @click="setRank(2)" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg aria-hidden="true" id='3' @click="setRank(3)" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg aria-hidden="true" id='4' @click="setRank(4)" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg aria-hidden="true" id='5' @click="setRank(5)" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
          </div>
          <div class="flex flex-row justify-evenly">
            <p class="text-white">Select a category: </p>
            <select v-model="selectedGameId">
                <option disabled value="">Choose</option>
                  <option v-for="game in games" :value="game.id" @click="selectGame">{{game.name}}</option>
            </select>
          </div>       
          <div class="flex row w-full justify-around">
            <RouterLink to='/' class="user--a">
                <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        @click="">Back</button>
            </RouterLink>               
            <button
            v-if="logged"
            type="button"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            @click="addReview()"
          >
            Valider
            </button>
          </div>
        </div>
     </div>
</div>
</template>
<script>
export default {
    name:"NewReview",
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
        this.getGames()
    },    
    data(){
        return {
            inputA:"",
            inputB:"",
            selected:"",
            image:null,
            games: [],
            user: '',
            selectedGameId: '',
            rank: 0,
            token: '',
            logged: false
        }
    },
    methods:{
      getGames() {
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
          this.games = data.games
        })
      },
      selectGame() {
        this.selectedGameId = event.target.value;
      },
      setRank(rank) {
        let stars = document.querySelectorAll('.w-5.h-5.text-gray-400')
         this.rank = rank
        stars.forEach(star => {
          if (star.id <= rank) {
            star.classList.add('text-yellow-400')
          } else {
            star.classList.remove('text-yellow-400')
          }
        });
      },
        addReview(){
          if (!this.inputA || !this.inputB || !this.selectedGameId) {
            if(!this.inputA) {
              document.querySelector('.warning--review').innerText = 'You must select a title'
            }
            if(!this.inputB) {
              document.querySelector('.warning--review').innerText = 'You type some content'
            }
            if(!this.selectedGameId) {
              document.querySelector('.warning--review').innerText = 'You must select a category'
            }            
            setTimeout(() => {
              document.querySelector('.warning--review').innerText = ''
            }, 3000);
          } else {
            var myHeaders = new Headers();
            myHeaders.append("Accept", "application/json");
            myHeaders.append('Authorization', 'Bearer ' + this.token);
  
            var formdata = new FormData();
            formdata.append("title", this.inputA);
            formdata.append("game_id", this.selectedGameId);
            formdata.append("picture", this.image);
            formdata.append("content", this.inputB);
            formdata.append("author_id", this.user.id);
            formdata.append("review_rank", this.rank);
  
            var requestOptions = {
              method: 'POST',
              headers: myHeaders,
              body: formdata,
              redirect: 'follow'
            };
  
            fetch("http://127.0.0.1:8000/api/reviews", requestOptions)
              .then(response => response.text())
              //.then(result => console.log(result))
              .then(() => window.location.href = '/')
              .catch(error => console.log('error', error));
          }
        },
        // onFilePicked(){
        //     this.$refs.fileInput.click()
        // },
        onFilePicked (event) {
        const files = event.target.files
        let filename = files[0].name
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
            this.imageUrl = fileReader.result
        })
        fileReader.readAsDataURL(files[0])
        this.image = files[0]
        // console.log(this.image)
        }
    }
}
</script>