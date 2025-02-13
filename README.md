<h1 align="center" id="title">Library Management system</h1>

<p id="description">Dashboard to manage a book-rental library.</p>

  
  
<h2>🧐 Features</h2>

Here're some of the project's best features:

*   Authentication
*   Book management
*   Author management
*   Lended books management
*   Two languages (Ar / En)
*   Filtering functionalities
*   Checking book availability.

<h2>🛠️ Installation Steps:</h2>

<p>1. Install Dependencies</p>

```
composer install
```
```
npm install
```

<p>2. Set Up the .env File</p>

```
cp .env.example .env
```

<p>3. Generate an Application Key</p>

```
php artisan key:generate
```

<p>4. Configure the Database</p>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

<p>5. To run the project:</p>

* Open 2 CMDs:

    + (1)
    ```sh
    php artisan migrate && php artisan serve
    ```

    + (2)
    ```sh
    npm run dev
    ```
