# Library Management System

A dashboard to manage a book-rental library.

## Features:

- Authentication
- Book management
- Author management
- Lended books management
- Multi-language support (Arabic / English)
- Filtering functionalities
- Book availability checker

## Installation Steps:

1. Install Dependencies:

```sh
composer install
```

```sh
npm install
```

2. Set Up the `.env` File:

```sh
cp .env.example .env
```

3. Generate an Application Key:

```sh
php artisan key:generate
```

4. Configure the Database:

Update the `.env` file with your database credentials:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

5. Run the Project:

Open **two terminal windows** and execute the following commands:

- **First Terminal (Migrate database & start the server):**

```sh
php artisan migrate && php artisan serve
```

- **Second Terminal (Compile frontend assets):**

```sh
npm run dev
```

Now, your **Library Management System** is up and running! 🚀📚
