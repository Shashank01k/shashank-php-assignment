
## Project A - CRUD API Documentation

**Project link :** [shashank-php-assignment](https://github.com/Shashank01k/shashank-php-assignment)

  Welcome to Project A! This CRUD API is designed to provide functionality for managing tasks and users within the system. Below is a comprehensive guide on how to use the API effectively.

## Setup and Usage

# Laravel Commands

  To set up authentication using Laravel Sanctum, follow these steps:

<p dir="auto">1. Install Laravel Sanctum:</p>
  <div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre>composer require laravel/sanctum</pre>
  </div>

2. Publish the Sanctum configuration file:
 <div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"</pre>
  </div>

3. Create a custom authentication middleware:
  <div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre> php artisan make:middleware AuthenticateMiddleware</pre>
  </div>

4. Create a default authentication middleware (if needed):
 
 <div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre> php artisan make:middleware Authenticate</pre>
  </div>

5. Create a seeder for the users table:
<div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre>php artisan make:seeder UsersTableSeeder</pre>
  </div>

6. Create a factory for generating fake user data:
<div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre>php artisan make:factory CommentFactory --model=Users</pre>
  </div>

7. Seed the database with dummy user data:
<div class="highlight highlight-source-shell notranslate position-relative overflow-auto" dir="auto" data-snippet-clipboard-copy-content="gem install github-linguist"><pre>php artisan db:seed</pre>
  </div>


These commands will help you set up Laravel Sanctum for API authentication and seed your database with dummy user data for testing purposes. Adjust the commands as necessary for your specific application needs.


1. Seeder API for Dummy Data:

  To populate the database with dummy user data, utilize the Seeder API provided by the user-seeder endpoint.


2. User Authentication:

  The API requires authentication using user email and remember_token as the password, retrieved from the users table in the database.
  Use the USER-LOGIN API endpoint for user login. Upon successful login, a token will be generated. This token must be included in the headers of subsequent API requests for access.


3. Task Management:

  Tasks can be created, updated, deleted, assigned, and unassigned via the API.
  Multiple users can be assigned to a single task simultaneously.
  Task status can be changed using enums: Pending, In-Progress, or Completed.


4. Filtering Data:

  Utilize the filtering-by parameter with options for status, due_date, or assigned_user to retrieve filtered data from the database.


## Database Schema

1. Tables:

  users: Contains user information including email and remember_token.
  
  users_tasks: Stores task details including assignment status and task status.
  
  users_tasks_masters: Master table for task assignments.


2. Database Name:

  The database name is project_a_db.


## API Endpoints

  API URL Example : http://127.0.0.1:8000/api/v1/search
  
  Endpoint: search

  # Seeder API Endpoint:
  
  Endpoint: /user-seeder
  
  Method: POST
  
  Description: Populates the database with dummy user data.
  
  User Login API Endpoint:
  
  Endpoint: /user-login
  
  Method: POST
  
  Description: Allows users to log in and retrieve authentication token for accessing other APIs.

  
  Task Management API Endpoints:
  
  Endpoint: |create | view | update/1 | delete/1 | assign_task | unassign_task/6 | change_task_status/2.
  
  Methods: POST, GET, PUT, DELETE
  
  Description: Create, retrieve, update, and delete tasks. Assign and unassign users to tasks. Change task status.

  
  Filtering Data API Endpoint:
  
  Endpoint: /search
  
  Method: GET
  
  Description: Retrieve filtered task data based on status, due date, or assigned user.
  

## Conclusion

  Project A CRUD API provides comprehensive functionality for managing tasks and users efficiently. For any further inquiries or assistance, please refer to the API documentation or contact our support team.

## Contact

  For any questions, feedback, or support related to Project A, feel free to reach out to us:
  
  Email: 19167shashankpandey@gmail.com
  
  GitHub Issues: https://github.com/Shashank01k/shashank-php-assignment/issues

  

############################################################################################################




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
