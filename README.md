<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## About The App

The app builds a CRUD interface to access, create, update or delete Companies, Subscriptions, Customers and Customer Subscriptions utilizing Sanctum for Bearer Token management and access managent.

Added queue sytem for importing customer CSV file.

Tables: Users (default), Companies, Subscriptions, Customers, Customer_Subscriptions
Sanctum for Bearer Token Access
Utilizes Resource object to return API responses


## Installation

1. Download repo to local
2. Update .env with database crendentials
3. Run `php artisan migrate`
4. Run `php artisan db:seed --class=Users`
5. Run `php artisan db:seed --class=Companies`
6. Run `php artisan db:seed --class=Subscriptions`
7. Run `php artisan db:seed --class=Customers`
8. Run `php artisan db:seed --class=CustomerSubscriptions`
9. Run `php artisan serve`

## CRUD Routes:

![image](https://user-images.githubusercontent.com/6032704/176812642-f80eb9d2-a1a6-4f10-84e8-654e8652c104.png)


## Registration API
# http://localhost:8000/api/register

![image](https://user-images.githubusercontent.com/6032704/176812022-a27b0df1-7cee-4f9a-b039-0ecc2a0535c0.png)

## Login API
# http://localhost:8000/api/login 

![image](https://user-images.githubusercontent.com/6032704/176812071-0fd7b9e8-277a-484f-b838-39cd509c7f08.png)

## API - Get Subscriptions By Customer
Be sure to include your Bearer Token from Register/Login
# http://localhost:8000/api/customer-subscriptions/customer/1 

![image](https://user-images.githubusercontent.com/6032704/176812132-4f1cf4af-2466-48ac-9f47-cc924cee6e23.png)

## Queue System for Customer CSV Upload
# http://localhost:8000/customer

1. Import `customers-import.csv`
2. Run `php artisan queue:work`

![image](https://user-images.githubusercontent.com/6032704/176889500-c2422048-6fd3-4999-a3c6-cb4f1a52c0d1.png)

![image](https://user-images.githubusercontent.com/6032704/176889542-61bd9fca-d504-4391-b1b6-1f42cac5ab18.png)

![image](https://user-images.githubusercontent.com/6032704/176889177-10298d2c-1e2b-4c54-9e09-77b760d7edcc.png)

After Execution:

![image](https://user-images.githubusercontent.com/6032704/176889688-f49be1a2-e501-4e83-92d4-b8a237af0dbf.png)

![image](https://user-images.githubusercontent.com/6032704/176889971-15725b77-b188-4166-b5cb-a3ff0a92d6d0.png)