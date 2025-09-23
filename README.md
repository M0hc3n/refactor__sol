# Laravel Refactoring Assessment
This is a basic laravel project with authentification scafolding to test new condidates's knowledge, ability to learn and how they tackle challenges.

## Prerequisites
- PHP installed
- Bruno installed https://www.usebruno.com/ (optional but it will help you)

## Steps to setup the project

1- clone the repo

2- run `cd refactor`

2- run `cp .env.example .env`

3- run `composer i`

4- run `php artisan key:generate`

5- run `php aritsan migrate`

6- run `composer dev`

## What You're Given

### 1. Working API Routes (`routes/api.php`)
A complete authentication system with these endpoints:
- `POST /register` - User registration
- `POST /login` - User login
- `GET /user` - Get authenticated user
- `PUT /user` - Update user profile
- `PUT /password` - Change password
- `POST /logout` - Logout current session
- `POST /logout-all` - Logout all sessions
- `GET /tokens` - List user tokens
- `DELETE /tokens/{id}` - Delete specific token
- `DELETE /user` - Delete user account

### 2. Bruno API Collection
Complete API testing collection with:
- Pre-configured requests for all endpoints
- Automatic token management
- Response validation tests
- Environment configuration

**Hint:** Use the provided Bruno collection to verify your refactored API works correctly.

- Import the Bruno collection
- Test all endpoints and ensure they work as expected
- Document any issues found and how you resolved them

## Your Tasks

### Task 1: Refactor to Controllers

**Objective:** Move all route closures to proper controller methods.

**Requirements:**
- Use laravel Action pattern
- Implement proper validation using Form Requests
- Follow Laravel naming conventions
- Use resource responses where appropriate

### Task 2: Controller Testing

**Objective:** Write http tests for your controllers.

**Requirements:**
- Create Http tests for all endpoints
- Test both success and failure scenarios
- Use proper test data and assertions


**Note:** This test is designed to evaluate your practical Laravel skills in a realistic scenario and your ability to learn and to communicate and exmplain your code. Finishing the work is not a strong requirement.
