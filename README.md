# Books API

- This is a simiple REST API project for CRUD operations on a single table. 
- The `books` table is consisting of `id`, `isbn`, `title`, `author`, `category` and `price`.
- The user should be able to filter books by `author` and/or `category`, and also create new books with validation of the `isbn` entity.

### Tech Stack

- This project is build using `Laravel` with `PHP` language, and usnig `PostgreSQL` database.

## Setup and testing procedure

- Pull `master` branch to your local machine, and open `pgAdmin` or the relevant database server that you have on your machine.
- From the `book_api` directory create a new `.env` file that hold the db configuration.
example for the db config (postgreSQL config):
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=
DB_PASSWORD=
```
- Then run `php artisan serve` from the same directory and make sure the app started on `http://127.0.0.1:8000` 
- Run `php artisan migrate` to make sure the `books` table is created.
- Run `php artisan db:seed` to create some entries for the table.
- Open an app like `postman` or `insomnia` that will allow us to do some CRUD requests on the API.
- The `url` in the app should match `http://localhost:8000/api/books` or `http://127.0.0.1:8000/api/books` and in the headers we shoould add the `Content-Type` and `Accept` keys to be `application/json`. 
- to get all the `books` we will use `GET` with url `http://localhost:8000/api/books`.
- to get specific book we will use `GET` with url `http://localhost:8000/api/books/{id}`.
- to get books with specific Author and/or category  we will use `GET` with url `http://localhost:8000/api/books?author={authorName}&category={category}`.
- To create a new book we will use `POST` with url `http://localhost:8000/api/books` and body 
```
{
    "isbn": "978-1491918661",
    "title": "Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5",
    "author": "Robin Nixon",
    "category": "Java",
    "price": "9.99"
}
```
- The `isbn` value should be accepted.
- Try the previous request again with `isbn` value `"978-INVALID1491918661"`, and make sure an exception is thrown and no entry is created.
