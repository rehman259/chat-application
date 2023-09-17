<h1 align="center">Realtime Chat Application</h1>

<p align="center">
  Welcome to the Realtime Chat Application, a chat platform built with Laravel 10, Vue.js, Laravel Websockets, and Laravel Echo. This application provides real-time chat functionality with user authentication, typing indicators, and a clean user-friendly interface.
</p>

## Key Features

- Real-time chat functionality.
- User authentication and registration.
- Message broadcasting.
- Typing indicators.
- Clean and user-friendly interface.

## Technologies Used

- **Laravel** for the backend server.
- **Vue.js** for the frontend user interface.
- **Laravel Websockets** for real-time websockets.
- **Laravel Echo** for for client side event listening.
- **Bootstrap** for styling.
- **MySQL** database.

## Getting Started

Follow these steps to get started with the Realtime Chat Application:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/rehman259/chat-application.git

2. **Install Laravel dependencies:**

   ```bash
   composer install

3. **Install Javascript dependencies:**

   ```bash
   npm install
   
4. **Configure your environment:**

    ```bash
    php artisan key:generate

5. **Run the migrations and seed the database:**

    ```bash
    php artisan migrate --seed

6. **Start the development server:**

   ```bash
   php artisan websockets:serve
   npm run dev 

## Contributions:

Contributions are welcome! If you'd like to contribute to this project, please feel free to open issues or submit pull requests.

## License:

This project is licensed under the MIT License - see the LICENSE.md file for details.
