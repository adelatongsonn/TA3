# Basic CodeIgniter POS System

This project is a basic four-page Point-of-Sale website created using CodeIgniter 4. It demonstrates how routes, controllers, views, and static PHP arrays work together using the MVC structure.

## Pages

The application contains the following pages:

- Home
- About
- Customer Accounts
- User Accounts

The Customer Accounts and User Accounts pages use static PHP arrays as temporary data sources. No database is used in this version.

## Requirements

Before running the project, install:

- PHP 8.1 or later
- Composer
- CodeIgniter 4 requirements
- Git

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/adelatongsonn/IT0049.git
   ```

2. Open the project folder:

   ```bash
   cd IT0049
   ```

3. Install the project dependencies:

   ```bash
   composer install
   ```

4. Create the `.env` configuration file:

   ```powershell
   Copy-Item env .env
   ```

5. Open the `.env` file and configure the environment and base URL:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8081/'
   ```

6. Start the CodeIgniter development server:

   ```bash
   php spark serve --port 8081
   ```

7. Open the application in your browser:

   ```text
   http://localhost:8081/
   ```

## Available Routes

| Page | URL |
|---|---|
| Home | `http://localhost:8081/` |
| About | `http://localhost:8081/about` |
| Customer Accounts | `http://localhost:8081/customers` |
| User Accounts | `http://localhost:8081/users` |

