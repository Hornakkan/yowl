<img src="https://lh3.googleusercontent.com/pw/AL9nZEUfGK1V79yeXkxnity2FkV7kEPupn-gsWB1t-su3DtOuu58x5xtt8iSPWrqhwwIvz0BPfPk8Ph0WQMZoLC8BBzjDOr3Vct6joxg_SGe1e8cpgzvmR-RffwB1_h2LDIqu0_sXKEmYrCteicaSXxgCDJo=w1569-h934-no?authuser=0" />

<b>YOWL project for Epitech school: Coding Academy 2022</b>

# Yowl: give your feedback on video games

By team Error 418: Sebastien Lacour, Sebastien Palanicaouden, Anne-Sophie Madelaine-Toublanc and Marc Pollet

## Headers

Yowl is a social media where you can give your feedback about video games by writing review. The community is allow to comment the review in order to bring their own opinion on this review.
We did this project in order to improve our background skills by creating a REST API with the framework Laravel 8 and our front-end skills with the framework VueJS v3.

## How to launch this project

#### Local server
Launch your own local server (Mamp/Xamp/...)

### Backend
<img src="https://user-images.githubusercontent.com/105637244/184220843-0cf7fad6-b84b-4dc3-880b-df5e42a93861.png" width="20"> <ins>*please be sure to be in the "back" folder*</ins> <img src="https://user-images.githubusercontent.com/105637244/184220843-0cf7fad6-b84b-4dc3-880b-df5e42a93861.png" width="20">

#### Laravel launch
php artisan serve

### Frontend

<img src="https://user-images.githubusercontent.com/105637244/184220843-0cf7fad6-b84b-4dc3-880b-df5e42a93861.png" width="20">  <ins>*please be sure to be in the "front" folder*</ins> <img src="https://user-images.githubusercontent.com/105637244/184220843-0cf7fad6-b84b-4dc3-880b-df5e42a93861.png" width="20">

#### install all the package
npm install

#### VueJS
npm run dev

#### tailwind
npm run tail

#### Sass
npm run sass

## Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

What is Laravel?

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## VueJS

<p align="center"><a href="https://vuejs.org/guide/introduction.html" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/langfr-330px-Vue.js_Logo_2.svg.png" width="200"></a></p>

What is VueJS?

Vue (pronounced /vjuː/, like view) is a JavaScript framework for building user interfaces. It builds on top of standard HTML, CSS and JavaScript, and provides a declarative and component-based programming model that helps you efficiently develop user interfaces, be it simple or complex.

## Purpose of this exercise

The purpose of this exercise was to create from scratch an online web application. For this, it was highly recommanded to use laravel has a backend solution and VueJS has a frontend solution.

## Langages / Technology

 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1067px-PHP-logo.svg.png" width="70"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="120">
 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Javascript_badge.svg/219px-Javascript_badge.svg.png?20160504163251" width="40"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/langfr-330px-Vue.js_Logo_2.svg.png" width="40">
 <img src="https://cdn-icons-png.flaticon.com/512/5968/5968267.png" width="40">
 <img src="https://cdn-icons-png.flaticon.com/512/5968/5968242.png" width="40"> <img src="https://cdn-icons-png.flaticon.com/512/919/919831.png" width="40"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Tailwind_CSS_Logo.svg/1200px-Tailwind_CSS_Logo.svg.png" width="40">

## Structure of our REST API Laravel Backend

### Model

-   Comment : Each comment "belongs to" a user and a review.
-   Game : This is the category of the review.
-   Review : Each review "belongs to" a game and a review "has many" comments.
-   User : Create user and allow to generate a new token when password is reset.

### View

<em><u> VueJS part </u></em>

### controller

-   Auth : dynamic and automatic generation of user_controller.

-   CommentsController

    -   createComments : Create a comment.
    -   readComments : return all the comments of the review.
    -   readOneComments : Return a comment.
    -   updateComments : Update a comment.
    -   deleteComments: Delete a comment.

-   gameController

    -   show : Return all games.

-   HomeController

    -   index : return the "home" view.

-   ReviewController

    -   index : Return all the reviews.
    -   myReview : Return the requested review.
    -   NewReview : Create the review.
    -   update : Update the review.
    -   destroy : Delete the review.

-   SearchController

    -   search : Return the requested review(s).

-   UserController

    -   Register : Create a user.
    -   Show : Return if a user exist or not.
    -   Show_all : Return all the users.
    -   Update : Update a user.
    -   Destroy : Delete a user.
    -   Login : Connect the user and generate a token.
    -   Logout : Disconnect the user and the related token.

### Route

-   Public
    -   Post -> "/register"
    -   Post -> "/login"
    -   Post -> "/password/email"
    -   Post -> "/password/reset"
    -   Get -> "/Games"
    -   Get -> "/reviews"
    -   Get -> "/reviews/{id}"
    -   Get -> "/reviews/{id}/comments"
    -   Get -> "/reviews/{id}/comments/{comments}"
    -   Get -> "/search/{query}"

-   Protected by middleware "auth:sanctum"
    -   Get -> "/users/{id}"
    -   Get -> "/users"
    -   Put -> "/users/{id}"
    -   Delete -> "/users/{id}"
    -   Post -> "/logout"
    -   Post -> "/reviews"
    -   Put -> "/reviews/{review}"
    -   Delete -> "/reviews/{review}"
    -   Post -> "/reviews/{review}/comments"
    -   Put -> "/reviews/{review}/comments/{comment}"
    -   Delete -> "/reviews/{review}/comments/{comment}"

## Structure of our VueJS Frontend

### Router

-   Home -> "/"
-   About -> "/about"
-   Apidocs -> "/apidocs"
-   Register -> "/register"
-   Profile -> "/profile"
-   Forgot -> "/forgot"
-   Reset -> "/reset"
-   Admin -> "/admin"
-   Review -> "/review/:id"
-   NewReview -> "/NewReview"
-   Search -> "/search/:search"

### views

-   App : Login and footer will be on each other view.
-   AboutView : Some informations about our working group.
-   AdminView : Display all the KPI and the link of the three CRUD : review, comments and user.
-   ApidocView : All the route we have used with the REST API.
-   FooterView : link with about us and API docs.
-   ForgotView : Forgot password view.
-   GameView : Add a game.
-   HomeView : Home view of the website with the login, the searchbar, the caroussel, all the reviews and the footer.
-   NewReview : Allow to add a review.
-   ProfileView : Allow to modify the profile user.
-   RegisterView : The user can create is account.
-   ResetView : Reset the password.
-   SearchView : vue of the searchbar.
-   TheReview : Display the review with the comment section.

### components

-   CarousselImage
-   Comment
-   ModalReview
-   Review
-   SearchBar
-   TheFooter
-   UserForgot
-   UserLogin
-   UserProfile
-   UserRegister
-   UserReset
    
---------

<p align="center"> # If you are here, thanks for your time ! </p>
