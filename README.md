<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## About The App

The app builds a CRUD interface to access, create, update or delete Companies, Subscriptions, Customers and Customer Subscriptions utilizing Sanctum for Bearer Token management and access managent.

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
8. Run `php artisan db:seed --class=Customer_Subscriptions`
9. Run `php aritisan serve`

## CRUD Routes:

![image](https://user-images.githubusercontent.com/6032704/176812642-f80eb9d2-a1a6-4f10-84e8-654e8652c104.png)


## Registeristration API
# http://localhost:8000/api/register

![image](https://user-images.githubusercontent.com/6032704/176812022-a27b0df1-7cee-4f9a-b039-0ecc2a0535c0.png)

## Login API
# http://localhost:8000/api/login 

![image](https://user-images.githubusercontent.com/6032704/176812071-0fd7b9e8-277a-484f-b838-39cd509c7f08.png)

## API - Get Subscriptions By Customer
Be sure to include your Bearer Token from Register/Login
# http://localhost:8000/api/customer-subscriptions/customer/1 

![image](https://user-images.githubusercontent.com/6032704/176812132-4f1cf4af-2466-48ac-9f47-cc924cee6e23.png)



