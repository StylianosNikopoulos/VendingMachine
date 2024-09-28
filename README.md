# Vending Machine Laravel

## Overview

This is a **Vending Machine** application built with **Laravel**.The application allows users to interact with a virtual vending machine, where they can deposit money, purchase products, and manage their accounts. Sellers can add, edit, and delete their products.

## Features

- **User Authentication**: Users can register, log in, and manage their sessions.
- **Deposit Management**: Buyers can deposit money into their accounts.
- **Product Management**: Sellers can add, edit, and remove products.

## Technologies Used

- **Laravel**: PHP framework for building web applications.
- **MySQL**: Database management system to store user and product information.

## Installation

To get started with this project, follow these steps:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/StylianosNikopoulos/VendingMachine-Laravel.git
    cd vending-machine
    ```

2. **Install dependencies**:

    Make sure you have Composer installed, then run:

    ```bash
    composer install
    ```

3. **Set up the environment file**:

    Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```
    Also create .env.testing for testing 

4. **Generate an application key**:

    ```bash
    php artisan key:generate
    ```

5. **Set up the database**:

    Update your `.env` file with your database credentials. Then run the migrations to set up the database tables:

    ```bash
    php artisan migrate
    ```

6. **Seed the database (optional)**:

    (First create at least one Seller)
    You can seed the database with sample data by running:

    ```bash
    php artisan db:seed
    ```

7. **Serve the application**:

    You can start the development server using:

    ```bash
    php artisan serve
    ```

    Your application will be accessible at `http://localhost:8000`.

## Usage

- **For Buyers**: 
  - Register or log in to your account.
  - Deposit money to your account.
  - Purchase products available in the vending machine.
  - You can log out of all sessions when you are logged in on multiple devices.

- **For Sellers**:
  - Register or log in to your account.
  - Add new products to your inventory.
  - Edit existing products or remove them as needed.
  - View your added products
  - View all products form vending machine
  - You can log out of all sessions when you are logged in on multiple devices.






