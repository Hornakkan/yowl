<template>
  <div
    id="modalEl"
    tabindex="-1"
    aria-hidden="true"
    class="modal bg-black/70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex"
  >
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
      <!-- Modal content -->
      <div class="relative  rounded-lg shadow bg-gray-700">
        <!-- Modal header -->
        <div
          class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600"
        >
          <h3
            class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white"
          >
            Update your review !
          </h3>
          <button
            type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            @click="$emit('closeMyModal')"
          >
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
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6 mx-auto" :class="{ shake: disabled }">
          <label for="inputName"></label>
          <input
            type="text"
            ref="inputA"
            class="w-full block px-8 py-3 text-sm font-medium bg-white rounded align-middle"
            placeholder="title ..."
            v-model="inputA"
            v-on:change="displayInputA(inputA)" 
          />
          <textarea
            type="text"
            ref="inputB"
            class="w-full h-48 block px-8 py-3 text-sm font-medium bg-white rounded align-middle"
            placeholder="Content ..."
            v-model="inputB"
            v-on:change="displayInputB(inputB)"
          />
          <div class="flex row w-full justify-end">
            <button
            type="button"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            @click="
              $emit('editReview');
              warnDisabled();
            "
          >
            Save
            </button>
          </div>
        </div>
        <!-- Modal footer -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ModalReview",
  data() {
    return {
      inputA: "",
      inputB:"",
      disabled: false,
      myReview:[],
      token: ''
    };
  },
  emits: ["editReview", "closeMyModal"],
  props: {
    displayInputA: Function,
    displayInputB: Function,
  },
  methods: {
    warnDisabled() {
      if (this.inputA == "") {
        this.disabled = true;
        setTimeout(() => {
          this.disabled = false;
        }, 1500);
      } else {
      }
    },
    fetchMyReview(id){
        var myHeaders = new Headers();
        myHeaders.append("Cookie", "XSRF-TOKEN=eyJpdiI6IkFoZ1pYelhWd3J2RHBNcy82dVV6N1E9PSIsInZhbHVlIjoiT0ZmeklIZDlKNi9BWmRWYjJBeE5OYitPamxTa1VMNFM5RGNQODBLc2o2SDZ6RnZ5REF2czkwYW9VTS9US0R5NTRFTzFndWVXc0xRMnIrRlpJY1VmQkFkclBTMTZ5Ui9xbFYyc01TZ2t4anRqbncyemd3czRoWkcvUXM1dHdFeVIiLCJtYWMiOiIxMmVlNWVhZjdlZTNlOTE5ZmY0ZjBlZTg2MGY1MjFiMzI3YTdjY2ZkMGMwNzM2MmVmNTYwZGNiOWYxYzg0NjllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InlseXM1cnZoRGU1WnBvcXVLYnNFRnc9PSIsInZhbHVlIjoiaDdNNmRNZEFHSTJxRDZxbzF1UWw3ZFNpMmFtNGtEdmxtM0pvekdBSnZpNWh4QmNIb1QzSTJQU21ENUYrWitCZEpFU3grV081eDQ0SEdyOXdqc3dEZFp3ajNCNGJINjZHaDIwQTVNWEVhVU8ySElPcE5hYzM1MW15Nnp1Y3craHoiLCJtYWMiOiI0YTEzNjUwY2FkZjkyM2Y0NDkzNWQwOTQ0MGM5ODk2YTM2MjAxNTBmODc1ODRhZDM3NDg0MTY5MTRhYWQ3YTU2IiwidGFnIjoiIn0%3D");
        myHeaders.append('Authorization', 'Bearer ' + this.token)
        myHeaders.append('Accept', 'application/json')
        myHeaders.append('Content-type', 'application/json')

        var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
        };

        fetch("http://127.0.0.1:8000/api/reviews/"+id, requestOptions)
        .then(response => response.json())
        .then(result => this.myReview = result)
        .then(result => this.myValue(result.title,result.content))          
        .catch(error => console.log('error', error));
            
    },
    myValue(title,content){
        this.inputA = title;
        this.inputB = content;
    }
  },
  mounted(){
    if (localStorage.getItem('token')) {
        this.token = localStorage.getItem('token')
    }
    if (sessionStorage.getItem('token')) {
        this.token = sessionStorage.getItem('token')
    }       
    this.fetchMyReview(this.$route.params.id);
  }
};
</script>
<style scoped>
.shake {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  transform: translate3d(0, 0, 0);
}
@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }
  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }
  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }
  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>
