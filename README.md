# Chirper — Laravel Official Bootcamp Project

A Twitter-like microblogging app built by following Laravel's official ["Getting Started with Laravel"](https://laravel.com/learn/getting-started-with-laravel) bootcamp (13 lessons) — my first guided, end-to-end Laravel project.

**Next step in this series:** [`03-blog-crm`](https://github.com/omereroglu1923/03-blog-crm) — the same fundamentals applied independently, without a course, plus new patterns (double `belongsTo` relationships, nested routes, search/filtering, two different authorization models).

## What it does

- User registration, login, and logout (session-based authentication)
- Post ("chirp"), edit, and delete short messages
- Only the author of a chirp can edit or delete it (Laravel Policies)
- An "edited" indicator that compares `updated_at` against `created_at` — no extra column needed

## What I learned building this

- MVC fundamentals in Laravel: routes → controllers → Eloquent models → Blade views
- Blade's component system (`@props` for data vs. `$slot` for content)
- Eloquent relationships (`belongsTo`, `hasMany`) and eager loading to avoid N+1 queries
- Authorization with Policies (`$this->authorize()` in controllers, `@can` in Blade) — and the easy-to-miss requirement that a controller must `use AuthorizesRequests` for `authorize()` to exist at all
- Full request lifecycle: Route → Middleware → Controller → View

## Tech stack

- **Laravel 13** (PHP 8.5)
- **Blade** templates
- **SQLite**

## Getting started

```bash
git clone https://github.com/omereroglu1923/02-chirper.git
cd 02-chirper
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
composer run dev
```

Visit `http://localhost:8000`.

## Part of a larger roadmap

This is Phase 1 of a self-directed full-stack roadmap (Laravel + DDD → React → React Native). Written notes from the learning process are kept in a private Obsidian vault and will gradually be published as articles.

## License

Personal learning project — not intended as a reusable package or template.
