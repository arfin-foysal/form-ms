## Form Management System

## Features

### Admin Portal: Configure JSON
- **Upload or Input JSON Data**: Define form fields with customizable properties.
- **JSON Fields Include**:
  - **Label**: Field label text.
  - **Placeholder**: Placeholder text.
  - **Input Type**: Text, dropdown, checkbox, etc.
  - **Required Status**: Mandatory or optional.
  - **Validation Rules**: Validation for input values.
  - **Button Configuration**: Submit/reset buttons.
- **Database Integration**: Save form configurations in the database.

### Dynamic Form Builder
- **Drag and Drop Interface**:
  - Drag fields to create or modify forms.
  - Rearrange form fields to change their order.
- **Persistence**:
  - All changes are saved to the database in real time.
  - Input fields loaded from stored JSON configurations.

### Form Management
- **Dashboard View**:
  - List all created forms.
  - View forms (render as configured).
  - Edit or delete existing forms.
- **Edit Functionality**:
  - Modify field properties or layout.
  - Update and save forms seamlessly.

### Form Display
- **Dynamic Form Rendering**:
  - Fetch form configuration from the server.
  - Render forms dynamically using Vue.js and Inertia.js.
- **Client-Side Validation**:
  - Validate user input based on JSON-defined rules.
  - No server submission required.

### Usage
- Access the **Admin Portal** to upload JSON or use the dynamic form builder.
- Manage forms through the dashboard (view, edit, delete).
- Render forms dynamically on the client side via Vue.js and Inertia.js.

## Tech Stack
- **Backend**: Laravel (with database for storing configurations).
- **Frontend**: Vue.js and Inertia.js for dynamic rendering and user interaction.
- **Database**: Stores JSON configurations and form metadata.

### Prerequisites
- PHP >= 8.1
- Laravel >= 11
- Node.js >= 18
- MySQL or any compatible database


## Instructions

1. Clone the repository
2. Run `composer install`
3. cp .`env.example .env or copy .env.example .env.`
4. Run `php artisan key:generate`
6. Create a database and update the `.env` file
8. Run `php artisan migrate:fresh --seed`
9. Run `php artisan serve`
10. Run `npm install`   
11. Run `npm run dev`
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