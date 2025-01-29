# Smart Inventory Management System (SIMS)

- Code by: `Amirul Hazim`
- Designed, Reviewed, CI/CD pipeline and Infrastructure prepared by: `Amir Nurhakim`

## Deployment
- Tagged commit with regex `vXX.XX.XX` following SemVer.

## Development Setup Guidelines

### Prerequisites
- PHP 8.1+
- Composer 2
- SQLite

### Installation Steps

1. **Clone Repository**
   ```bash
   git clone https://github.com/amirrhkm/sims.git
   cd sims
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   Configure SQLite database:
   ```env
   DB_CONNECTION=sqlite
   ```

4. **Database Setup**
   ```bash
   php artisan migrate:fresh
   ```

5. **Seed Initial Data**
   ```bash
   php artisan db:seed
   ```

6. **Application Key**
   ```bash
   php artisan key:generate
   ```

7. **Launch Development Server**
   ```bash
   php artisan serve
   ```

Access the development environment at `http://localhost:8000`

## Database Management
For database visualization and management, use TablePlus and import the `database.sqlite` file from the `database` directory.
