## AICHAT ASSESMENT

### Built With

* [![Laravel][Laravel.com]][Laravel-url]

### Database
* Mysql

### Installation

**Requirement**
- PHP >= 7.4
- MySQL  >= 8.0
- Composer

**Setup**
1. Clone the repo
   ```sh
   git clone https://github.com/BatuBata/aichat-assessment.git
   ```
2. Move to project
   ```sh
   cd aichat-assessment
   ```
3. Install Composer package
   ```sh
   composer install
   ```
4. Copy env example from the project
   ```sh
   cp .env.example .env
   ```
5. Setup the database config from env file for your computer/server
   ```sh
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
   ```
6. Run database migration and seeder
    ```sh
     php artisan migrate:fresh --seed
    ```
7. Generate key for your project
    ```sh
     php artisan key:generate
    ```
8. Run your project
    ```sh
     php artisan serve
    ```
9. Run laravel scheduller locally
    ```sh
     php artisan scheduller:work
    ```


### API Documentation

**Table**

| URL                                               | METHOD            |
| ------------------------------------------------- | ----------------- |
| /api/customer/{customer_id}/eligible-check        | GET               |
| /api/customer/{customer_id}/validate-submission   | GET               |

**Request**

`GET /api/customer/{customer_id}/eligible-check`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/customer/1/eligible-check

**Response**

    HTTP/1.1 200 OK
    Date: Thu, 24 July 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {
        "code": 200,
        "status": true,
        "message": "Successfuly locked a voucher for customer",
        "data": {
            "id": 4,
            "first_name": "Jeramie",
            "last_name": "Schumm",
            "gender": "Female",
            "date_of_birth": "08-08-1997",
            "contact_number": "731.715.4013",
            "email": "buckridge.ramon@strosin.com",
            "voucher": {
                "id": 2,
                "code": "8aePfm",
                "status": "Locked",
                "expired_at": "25-07-2022 15:38:28"
            }
        }
    }


**Request**

`GET /api/customer/{customer_id}/validate-submission`

    curl -i -H 'Accept: application/json' http://localhost:8000/api/customer/1/validate-submission

**Response**

    HTTP/1.1 200 OK
    Date: Thu, 24 July 2022 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {
        "code": 200,
        "status": true,
        "message": "Successfuly redeemed a voucher for customer",
        "data": {
            "id": 4,
            "first_name": "Jeramie",
            "last_name": "Schumm",
            "gender": "Female",
            "date_of_birth": "08-08-1997",
            "contact_number": "731.715.4013",
            "email": "buckridge.ramon@strosin.com",
            "voucher": {
                "id": 2,
                "code": "8aePfm",
                "status": "Redeemed",
                "expired_at": "25-07-2022 15:38:28"
            }
        }
    }

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com