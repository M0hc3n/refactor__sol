# Laravel Sanctum API Refactoring Test

## Overview

This is a practical test designed to evaluate your Laravel development skills, specifically focusing on:
- **API architecture and organization**
- **Controller design patterns**
- **Testing methodologies**
- **API documentation and testing tools**

You'll be working with a functional Laravel Sanctum authentication API that currently uses closure-based routes. Your task is to refactor this into a proper, well-structured Laravel application following best practices.

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

## Your Tasks

### Task 1: Refactor to Controllers (Required)

**Objective:** Move all route closures to proper controller methods.

**Requirements:**
- Create appropriate controllers (e.g., `AuthController`, `UserController`, `TokenController`)
- Use proper HTTP status codes and response formats
- Implement proper validation using Form Requests
- Follow Laravel naming conventions
- Use resource responses where appropriate
- Implement proper error handling

**Deliverables:**
- [ ] `app/Http/Controllers/AuthController.php`
- [ ] `app/Http/Controllers/UserController.php`
- [ ] `app/Http/Controllers/TokenController.php`
- [ ] `app/Http/Requests/` - Form request classes
- [ ] Updated `routes/api.php` pointing to controllers
- [ ] Proper response formatting (consider using API Resources)

### Task 2: API Testing (Required)

**Objective:** Use the provided Bruno collection to verify your refactored API works correctly.

**Requirements:**
- Import the Bruno collection
- Configure the environment variables
- Test all endpoints and ensure they work as expected
- Document any issues found and how you resolved them

**Deliverables:**
- [ ] Screenshot/video of successful API tests
- [ ] Brief report on any issues encountered during testing

### Task 3: Controller Testing (Required)

**Objective:** Write comprehensive tests for your controllers.

**Requirements:**
- Create Feature tests for all endpoints
- Test both success and failure scenarios
- Test authentication and authorization
- Use Laravel's built-in testing features (factories, etc.)
- Achieve good test coverage
- Use proper test data and assertions

**Deliverables:**
- [ ] `tests/Feature/AuthControllerTest.php`
- [ ] `tests/Feature/UserControllerTest.php`
- [ ] `tests/Feature/TokenControllerTest.php`
- [ ] All tests should pass (`php artisan test`)

### Task 4: Documentation (Bonus)

**Objective:** Document your API properly.

**Requirements:**
- Create API documentation (can use tools like Scribe, or manual documentation)
- Document all endpoints with request/response examples
- Include authentication requirements
- Add setup instructions

## Getting Started

### 1. Setup Laravel Project
```bash
# Create new Laravel project or use existing one
composer create-project laravel/laravel sanctum-api-test
cd sanctum-api-test

# Install Laravel Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

# Configure Sanctum (add to api middleware in app/Http/Kernel.php)
```

### 2. Setup the Initial API Routes
- Copy the provided `routes/api.php` content to your project
- Make sure your User model uses `HasApiTokens` trait
- Test that the routes work with the Bruno collection

### 3. Setup Bruno API Testing
- Install [Bruno](https://usebruno.com/)
- Import the collection under `Bruno-api` folder into Bruno

### 4. Start Refactoring
Begin with Task 1 and work your way through each requirement.

## Evaluation Criteria

### Code Quality (40%)
- [ ] Clean, readable code with proper formatting
- [ ] Following Laravel conventions and best practices
- [ ] Proper separation of concerns
- [ ] DRY (Don't Repeat Yourself) principles
- [ ] Proper error handling

### Architecture (30%)
- [ ] Logical controller organization
- [ ] Proper use of Form Requests for validation
- [ ] Appropriate use of Laravel features (middleware, resources, etc.)
- [ ] RESTful API design principles

### Testing (20%)
- [ ] Comprehensive test coverage
- [ ] Tests actually test the functionality
- [ ] Good test organization and naming
- [ ] Use of factories and proper test data

### Documentation & Communication (10%)
- [ ] Clear commit messages
- [ ] Code comments where necessary
- [ ] Documentation quality
- [ ] Following the provided instructions

## Submission Guidelines

### Required Files
Submit a ZIP file or GitHub repository containing:
```
laravel-sanctum-refactor/
├── app/Http/Controllers/          # Your controllers
├── app/Http/Requests/             # Form request classes
├── tests/Feature/                 # Your test files
├── routes/api.php                 # Updated routes
├── README.md                      # Your documentation
└── bruno-test-results/            # Screenshots/proof of API testing
```

### Timeline
- **Estimated Time:** 4-6 hours
- **Deadline:** [Insert your deadline here]

### What We're Looking For
1. **Problem-solving skills** - How you approach refactoring existing code
2. **Laravel expertise** - Proper use of framework features
3. **Testing mindset** - Writing meaningful tests
4. **Attention to detail** - Following requirements precisely
5. **Communication** - Clear documentation and code

## Common Pitfalls to Avoid

❌ **Don't:**
- Copy-paste the closure code directly into controllers without refactoring
- Skip validation or use basic `$request->validate()` everywhere
- Write tests that don't actually test functionality
- Ignore error handling
- Forget to update route definitions

✅ **Do:**
- Use Form Requests for complex validation
- Implement proper HTTP status codes
- Write descriptive test names and assertions
- Use Laravel's built-in features appropriately
- Keep controllers thin and focused

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [Bruno Documentation](https://docs.usebruno.com/)
- [Laravel Testing Documentation](https://laravel.com/docs/testing)
- [REST API Best Practices](https://restfulapi.net/)

## Questions?

If you have any questions about the requirements or need clarification, please don't hesitate to ask. Good luck!

---

**Note:** This test is designed to evaluate your practical Laravel skills in a realistic scenario. Take your time to understand the existing code before refactoring, and don't forget to test your changes thoroughly.
