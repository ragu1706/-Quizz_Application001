# Online Quiz System

A PHP + MySQL multiple-choice quiz application. Teachers can securely sign in to manage questions and view/delete submitted results. Students can take the quiz, and scores are calculated on the server.

## Features

- Responsive Bootstrap interface
- Teacher password gate (configured with an environment variable)
- Add, edit, and delete quiz questions
- Student quiz submissions and server-side score calculation
- Results list for teachers
- PDO prepared statements, HTML output escaping, CSRF tokens, and POST-only destructive actions
- No database credentials or teacher password committed to the repository

## Requirements

- PHP 8.0+ (PHP 8.1+ recommended) with `pdo_mysql` enabled
- MySQL 8+ or MariaDB 10.4+
- Apache, Nginx, or PHP's local development server

> GitHub Pages only hosts static files. This project uses PHP and MySQL, so it must run on a PHP-capable host (or locally with XAMPP/MAMP/LAMP); uploading it to GitHub Pages alone will not run the application.

## Local setup with XAMPP

1. Install and start Apache and MySQL in XAMPP.
2. Copy the project folder into `htdocs/online-quiz-system`.
3. Open phpMyAdmin and import `online_quiz_db.sql`.
4. Configure environment variables for PHP/Apache:
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_NAME=online_quiz_db`
   - `DB_USER=root`
   - `DB_PASSWORD=` (use your actual local MySQL password)
   - `TEACHER_PASSWORD=` set to a long, unique password
5. Restart Apache after setting environment variables.
6. Open `http://localhost/online-quiz-system/`.

If your environment does not pass environment variables into Apache, set them in your PHP hosting control panel or server configuration. Do not hardcode production secrets into `conn/conn.php` or commit them to GitHub.

## Run with PHP's built-in server

After creating the database and setting the environment variables in your shell:

```bash
export DB_HOST=127.0.0.1
export DB_PORT=3306
export DB_NAME=online_quiz_db
export DB_USER=root
export DB_PASSWORD='your-local-db-password'
export TEACHER_PASSWORD='use-a-long-unique-password'
php -S 127.0.0.1:8000
```

Then visit `http://127.0.0.1:8000`. The built-in server is for local development only, not production hosting.

## GitHub workflow

```bash
git init
git add .
git commit -m "Harden online quiz system"
git branch -M main
git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
git push -u origin main
```

Replace the remote URL with your repository. Configure database credentials and `TEACHER_PASSWORD` in your PHP host's environment settings. Import `online_quiz_db.sql` into the hosted database and update the environment values to match it.

## Security notes

- Teacher pages and question/result mutation endpoints require a teacher session.
- The application does not send correct answers to the student's browser.
- Submitted scores are recomputed from the database on the server.
- Forms use CSRF tokens; delete operations use POST.
- Production deployment should use HTTPS, secure database credentials, backups, and restricted database permissions.
- The teacher login uses a single configured password for this compact starter project. For multi-teacher or public production use, implement individual teacher accounts with `password_hash()`/`password_verify()`, rate limiting, and password reset controls.

## Project structure

```text
online-quiz-system/
├── assets/                 # CSS and JavaScript
├── conn/conn.php           # PDO database connection
├── endpoint/               # Form handlers
├── partials/               # Shared page header/footer
├── config.php              # Session, escaping, CSRF and auth helpers
├── index.php               # Landing page
├── student.php             # Student landing page
├── take-quiz.php           # Quiz form (no answer key sent to browser)
├── result.php              # Submission result
├── teacher-login.php       # Teacher login
├── teacher.php              # Teacher dashboard
├── logout.php               # POST-only logout
└── online_quiz_db.sql       # Database schema and sample question
```
