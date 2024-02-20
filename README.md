# Technical test SGG

This project is built with Laravel and styled using Tailwind CSS. It provides CRUD functionality for both Departments and Users. Users can be assigned to specific Departments, and a hierarchical structure is implemented for Departments. Additionally, there's a dedicated view to visualize the global hierarchy of Departments.

File with requisited added in the root folder (technical_test_r89.pdf).

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

### Prerequisites

List any software, libraries, or other prerequisites needed before getting started.

- [Laravel requisites](https://laravel.com/docs/10.x/deployment#server-requirements)
- NPM


## Installation

To get this project up and running, follow these steps:


1. Clone the repository:
```bash
git clone https://github.com/Troyer-x/sgg```

2. Navigate to the project folder:
```bash
cd sgg```

3. Install Composer dependencies:
```bash
composer install```

4. Install NPM dependencies:
```bash
npm install```

5. Run database migrations:
```bash
php artisan migrate```

6. Seed the database:
```bash
php artisan db:seed```

7. Compile and run:
```bash
npm run dev```
