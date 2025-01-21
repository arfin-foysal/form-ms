## Form Management System

## Features

- **Admin Portal**
    - **Configure Json**
        - There will be an option to input JOSN file/JSON data that define form fields, including label, placeholder, input type, button, required status, validation rules etc.
        - Admin should be able to save these configurations in the database.
    - **Dynamic Form Builder**
        - Build a dynamic form builder interface where admins can drag and drop input fields to create or modify forms or change form element's serial. These input fields will come from the DB, stored in previous step.
        - Ensure that changes made through the UI are persistent
    - **Form Management**
        - List all created forms in a dashboard with options to view(Form Display), edit.
        - Provide functionality to edit existing forms by modifying the fields and updating the form layout.
    - **Form Display**
        - Fetch the form configuration from the server and render the form dynamically on the client side using Vue.js and Inertia.js.
        - Validate the user input based on the rules defined in the JSON configuration no need to post in server.


## Instructions

1. Clone the repository
2. Run `composer install`
3. cp .`env.example .env or copy .env.example .env.`
4. Run `php artisan key:generate`
6. Create a database and update the `.env` file
8. Run `php artisan migrate:fresh --seed`
9. Run `php artisan serve`
10. Run `NPM Install`   
11. Run `NPM Run Dev`
12. Visit `http://localhost:8000` in your browser
13. Admin Login
    - Visit `http://localhost:8000/login`
    - Email: `test@example.com`
    - Password: `12345678`




## About Me
- **Foysal Ahmmad Arfin**
- **Software Engineer (PHP, Javascript, Laravel, Nodejs)**
- **Email:af.arfinfoysal@gmail.com**


## Follow Me on Social Media 
- **[Linkedin](https://www.linkedin.com/in/arfinfoysal/)**
- **[Github](https://github.com/arfin-foysal/)**


## ========Thank You========