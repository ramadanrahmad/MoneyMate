# MoneyMate 💰

MoneyMate is a modern, intuitive, and feature-rich personal finance management application built with Laravel. It helps you track your income, expenses, and savings seamlessly while providing deep insights into your financial habits.

## ✨ Features

- **Dashboard & Analytics:** Get a clear overview of your current balance, total income, and total expenses. Visualized with interactive Pie Charts using Chart.js.
- **Transaction Management:** Easily add, edit, or delete transactions. Categorize them to see exactly where your money goes.
- **Smart Filtering:** Filter your financial data by specific months to analyze your spending habits over time.
- **Beautiful Dark Mode:** Fully supported, seamless dark mode that syncs with your system preferences or can be toggled manually. 🌙
- **Category Management:** Create and manage custom categories for your transactions.
- **Secure Authentication:** Built-in secure user registration, login, and profile management using Laravel Breeze.
- **Responsive Design:** A premium, modern UI crafted with Tailwind CSS that works beautifully on desktop and mobile devices.

## 🛠️ Tech Stack

- **Backend:** [Laravel](https://laravel.com/) (PHP)
- **Frontend:** HTML, Blade Templates, [Tailwind CSS](https://tailwindcss.com/)
- **Interactivity:** [Alpine.js](https://alpinejs.dev/) & JavaScript
- **Charts:** [Chart.js](https://www.chartjs.org/)
- **Database:** MySQL / SQLite

## 🚀 Getting Started

Follow these steps to set up the project locally on your machine.

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL / MariaDB (or SQLite)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ramadanrahmad/MoneyMate.git
   cd MoneyMate
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```
   Configure your database credentials inside the `.env` file.

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Compile Assets**
   ```bash
   npm run build
   ```

8. **Start the Local Server**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
