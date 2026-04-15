# ExpenseMate - Expense Tracking and Management System

A Laravel-based web application for tracking personal expenses and income.

## Requirements

- PHP 8.2+
- Composer
- SQLite (default) or MySQL

## Installation

1. **Navigate to project directory:**
   ```bash
   cd C:\xampp\htdocs\EXPENSEMATEGROUP8
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Run migrations:**
   ```bash
   php artisan migrate
   ```

4. **Start the server:**
   ```bash
   php artisan serve
   ```

5. **Open browser:**
   Visit `http://localhost:8000`

## Features

### Authentication
- User registration
- User login
- Secure logout

### Dashboard
- Total income summary
- Total expenses summary
- Balance calculation
- Recent transactions (latest 5)

### Expense Management
- Add expense (title, amount, category, date)
- Edit expense
- Delete expense
- List all expenses

### Income Management
- Add income (source, amount, date)
- Edit income
- Delete income
- List all income records

### Categories
Predefined expense categories:
- Food
- Bills
- Transport
- Shopping
- Others

## Database Structure

### Users Table
- id, name, email, password (hashed)

### Expenses Table
- id, user_id (FK), title, amount, category, date, timestamps

### Incomes Table
- id, user_id (FK), source, amount, date, timestamps

## Using MySQL Instead of SQLite

1. Create a database named `expensemate` in MySQL
2. Update `.env` file with your MySQL credentials
3. Run: `php artisan migrate:fresh`

## Start the Application

```bash
php artisan serve
```

Then visit `http://localhost:8000`

## License

MIT License
