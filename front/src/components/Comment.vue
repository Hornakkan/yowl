<template>
    <div class="my_comment flex items-center pl-6 pr-6 w-full">
        <!-- <img :src="comment.author_avatar_urls[96]" class="h-6 w-6 rounded-full" alt="author" /> -->
        <div class="w-1/3 flex flex-col ml-2 p-4">
            <span class="font-bold text-black text-sm" v-html="comment.user.name"></span>
            <!-- <span v-html="comment.created_at"></span> -->
            <span v-if="date !='Invalid Date'">{{ date }} {{ time }}</span>
            
        </div>
        <div class="bg-white shadow-xl w-2/3 leading-normal text-lg">
            <div v-show="!isEditing" v-html="comment.content"></div>
            <textarea v-show="isEditing || isNew" class="form-control block w-full py-1.9 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="2" cols="60" placeholder="Enter your comment here ..." v-model="comment.content"></textarea>
        </div>
        <div class="flex items-center p-6 space-x-2">
            <button v-show="!isEditing" v-if="!isNew && user.id == comment.author_id" @click="update_comment">Update</button>
            <button v-show="!isEditing" v-if="!isNew && (user.id == comment.author_id || user.admin)" @click="delete_comment">Delete</button>
            <button v-show="isEditing" @click="save_updated_comment" data-modal-toggle="defaultModal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Save
            </button>
            <button v-if="isNew" @click="save_comment" data-modal-toggle="defaultModal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Save
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: ["isNew", "comment"], //propriétés passée du parent au fils
    data() {
        return {
            isEditing: false,
            user: '',
            date: new Date(this.comment.created_at).toLocaleDateString('FR'),
            time: new Date(this.comment.created_at).toLocaleTimeString('FR'),
        }
    },
    mounted() {
        let localUser = localStorage.getItem('user')
        let sessionUser = sessionStorage.getItem('user')    
        if (localUser){
            this.user = JSON.parse(localUser)
        }
        if(sessionUser){
            this.user = JSON.parse(sessionUser)
        }
    },
    methods : {
        async update_comment(){
            this.isEditing = true
        },
        async save_updated_comment() {
            this.$emit('updateComment', this.comment)
            this.isEditing = false
        },
        async delete_comment(){
            this.$emit('deleteComment', this.comment)
        },
        async save_comment(){
            this.$emit('saveComment', this, this.comment)
        }
    }
}

</script>