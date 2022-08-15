<template>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <main>
    <h1 class="api--title">Team Error 418</h1>
    <h2 class="api--subtitle">for Epitech's school</h2>
    <div class="api--wrapper">
      <div class="api--container">
        <div class="api--routes" id="apiroutes" @click="showRoutes">
          <h2 class="api--routes--title">Routes</h2>
          <h2 class="api--routes--title">Public routes</h2>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">POST</span>
              <span class="api--routes--route--phrase--uri post">/register</span>
            </p>
            <div class="api--routes--route--content">
              Register one user
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">POST</span>
              <span class="api--routes--route--phrase--uri post">/login</span>
            </p>
            <div class="api--routes--route--content">
              Sign in one user
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">POST</span>
              <span class="api--routes--route--phrase--uri post">/password/email</span>
            </p>
            <div class="api--routes--route--content">
              Send one email to a user with reset link in case of forgotten password and a token
            </div>
          </div>        
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">POST</span>
              <span class="api--routes--route--phrase--uri post">/password/reset</span>
            </p>
            <div class="api--routes--route--content">
              Reset the password of one user according to the token passed in the URL
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">GET</span>
              <span class="api--routes--route--phrase--uri post">/games</span>
            </p>
            <div class="api--routes--route--content">
              Retrieve all the games
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb get">GET</span>
              <span class="api--routes--route--phrase--uri get">/reviews</span>
            </p>
            <div class="api--routes--route--content">
              Retrieve all reviews
            </div>            
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb get">GET</span>
              <span class="api--routes--route--phrase--uri get">/reviews/{id}</span>
            </p>
            <div class="api--routes--route--content">
              Show one review
            </div>
          </div>            

          <h2 class="api--routes--title">Protected routes</h2>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb get">GET</span>
              <span class="api--routes--route--phrase--uri get">/users</span>
            </p>
            <div class="api--routes--route--content">
              Show all users from DB, check for admin rights to do so
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb get">GET</span>
              <span class="api--routes--route--phrase--uri get">/users/{id}</span>
            </p>
            <div class="api--routes--route--content">
              Show one user
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb put">PUT</span>
              <span class="api--routes--route--phrase--uri put">/users/{id}</span>
            </p>
            <div class="api--routes--route--content">
              Update one user
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb delete">DELETE</span>
              <span class="api--routes--route--phrase--uri delete">/users/{id}</span>
            </p>
            <div class="api--routes--route--content">
              Delete one user
            </div>
          </div>
          <div class="api--routes--route">
            <p class="api--routes--route--phrase">
              <span class="api--routes--route--phrase--verb post">POST</span>
              <span class="api--routes--route--phrase--uri post">/logout</span>
            </p>
            <div class="api--routes--route--content">
              Logout the user currently signed in user
            </div>
          </div>
        <div class="api--routes--route">
          <p class="api--routes--route--phrase">
            <span class="api--routes--route--phrase--verb get">POST</span>
            <span class="api--routes--route--phrase--uri get">/reviews</span>
          </p>
          <div class="api--routes--route--content">
            Store one new review
          </div>
        </div>        
        <div class="api--routes--route">
          <p class="api--routes--route--phrase">
            <span class="api--routes--route--phrase--verb get">PUT</span>
            <span class="api--routes--route--phrase--uri get">/reviews/{id}</span>
          </p>
          <div class="api--routes--route--content">
            Update one review
          </div>
        </div>          
        <div class="api--routes--route">
          <p class="api--routes--route--phrase">
            <span class="api--routes--route--phrase--verb get">DELETE</span>
            <span class="api--routes--route--phrase--uri get">/reviews/{id}</span>
          </p>
          <div class="api--routes--route--content">
            Delete one review
          </div>
        </div>                
        </div>
      </div>    
      <div class="api--container">
        <div class="api--routes" id="apimodel">
          <h1 class="api--subtitle">
            Eloquent models
          </h1>
          <div class="api--routes--route">
            <p class="api--routes--route--model" @click="showContent('users')">
              <span class="api--routes--route--model--table">Users</span>
              <span class="api--routes--route--model--icon"><i class="bi bi-caret-right" id="users"></i></span>
              <span class="api--routes--route--model--content">
                <ul>
                  <li>
                    <p class="api--ressource--name">id <i class="bi bi-key-fill"></i></p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">name</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">email</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">password</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">admin</p>
                    <p class="api--ressource--type">boolean</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">birthdate</p>
                    <p class="api--ressource--type">date</p>
                  </li>
                </ul>
              </span>
            </p>
            <!-- next model -->
            <p class="api--routes--route--model" @click="showContent('reviews')">
              <span class="api--routes--route--model--table">Reviews</span>
              <span class="api--routes--route--model--icon"><i class="bi bi-caret-right" id="reviews"></i></span>
              <span class="api--routes--route--model--content">
                <ul>
                  <li>
                    <p class="api--ressource--name">id <i class="bi bi-key-fill"></i></p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">title</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">game_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">posted_at</p>
                    <p class="api--ressource--type">date</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">picture</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">content</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">author_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">reviewer_rank</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                </ul>
              </span>
            </p>            
            <!-- next model -->
            <p class="api--routes--route--model" @click="showContent('comments')">
              <span class="api--routes--route--model--table">Comments</span>
              <span class="api--routes--route--model--icon"><i class="bi bi-caret-right" id="comments"></i></span>
              <span class="api--routes--route--model--content">
                <ul>
                  <li>
                    <p class="api--ressource--name">id <i class="bi bi-key-fill"></i></p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">author_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">review_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">content</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">posted_at</p>
                    <p class="api--ressource--type">date</p>
                  </li>
                </ul>
              </span>
            </p>                 
            <!-- next model -->
            <p class="api--routes--route--model" @click="showContent('likes')">
              <span class="api--routes--route--model--table">Likes</span>
              <span class="api--routes--route--model--icon"><i class="bi bi-caret-right" id="likes"></i></span>
              <span class="api--routes--route--model--content">
                <ul>
                  <li>
                    <p class="api--ressource--name">id <i class="bi bi-key-fill"></i></p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">review_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">author_id</p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">like</p>
                    <p class="api--ressource--type">boolean</p>
                  </li>
                </ul>
              </span>
            </p>                   
            <!-- next model -->
            <p class="api--routes--route--model" @click="showContent('games')">
              <span class="api--routes--route--model--table">Games</span>
              <span class="api--routes--route--model--icon"><i class="bi bi-caret-right" id="games"></i></span>
              <span class="api--routes--route--model--content">
                <ul>
                  <li>
                    <p class="api--ressource--name">id <i class="bi bi-key-fill"></i></p>
                    <p class="api--ressource--type">integer</p>
                  </li>
                  <li>
                    <p class="api--ressource--name">name</p>
                    <p class="api--ressource--type">string</p>
                  </li>
                </ul>
              </span>
            </p>                   
            <!-- next model -->            
          </div>
        </div>
      </div>
    </div>
  </main>  
</template>

<script>
export default {
  methods: {
    showContent(table) {
      if (event.target.className == 'api--routes--route--model' || event.target.className == 'api--routes--route--model active') {
        event.target.classList.toggle('active')
      } else if (event.target.className == 'api--routes--route--model--table' || event.target.className == 'api--routes--route--model--table active') {
        event.target.parentElement.classList.toggle('active')
      } else {
        event.target.parentElement.parentElement.classList.toggle('active')
      }

      let myTarget = document.getElementById(table)

      if (myTarget.className == 'bi bi-caret-right') {
        myTarget.className = 'bi bi-caret-down'
        myTarget.style.color = 'gold'
      } else {
        myTarget.className = 'bi bi-caret-right'
        myTarget.style.color = 'black'
      }
    },
    showRoutes() {
      let myTarget = document.querySelector('#apiroutes')
      myTarget.scrollTop = 0
      myTarget.classList.toggle('activeroute')
    }
  }
}
</script>