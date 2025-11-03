# HausTap Capstone — Monorepo

This repository contains multiple projects used across the HausTap Capstone:

- Web app (PHP) — `Haustap_Capstone-Haustap_Connecting/Haustap_Capstone-Haustap_Connecting`
- Admin panel (PHP) — `admin_haustap/admin_haustap`
- Root MVC app (PHP) — `public/`, `core/`, `app/`
- Mobile app (Expo/React Native) — `android-capstone-main/HausTap`
- Mock API (PHP) — `mock-api`
- Backend libraries — `backend`

No UI or UX changes are introduced by this document.

## Prerequisites

- `PHP 8.1+`
- `Composer`
- `Node.js 18+` and `npm` (or `yarn`)
- `Git`

## Environment Files

- Root examples: `.env.example`, `.env.development`, `.env.staging`, `.env.production`
- Mobile app: `android-capstone-main/HausTap/.env`

Create local `.env` files from the provided examples and fill credentials as needed. Secrets are ignored by Git.

## Quick Start After Pull

1. Clone the repo:
   - `git clone https://github.com/lastra1/Haustap_Capstone.git`
2. Web app (nested):
   - `cd Haustap_Capstone/Haustap_Capstone-Haustap_Connecting/Haustap_Capstone-Haustap_Connecting`
   - `php -S localhost:8002 router.php`
   - Open `http://localhost:8002/`
3. Admin panel:
   - `php -S localhost:8003 -t admin_haustap/admin_haustap`
   - Open `http://localhost:8003/dashboard.php`
4. Root MVC app:
   - `php -S localhost:8001 -t public`
   - Open `http://localhost:8001/`
5. Mobile app:
   - `cd android-capstone-main/HausTap`
   - `npm install`
   - `npm run start` (or `npx expo start`)
6. Backend libraries (if needed by your setup):
   - `cd backend`
   - `composer install`
   - Ensure any integration points in the PHP apps reference `backend/vendor/autoload.php` correctly.
7. Mock API (optional):
   - `php -S localhost:8009 -t mock-api`
   - Configure endpoints via `mock-api/config.php`

## Git Ignore & Line Endings

- A comprehensive `.gitignore` avoids committing OS, IDE, build, vendor, and secret files.
- `.gitattributes` ensures consistent line endings across platforms without changing UI/UX.

## Pushing to GitHub (Replace Contents)

From the repo root:

- `git init`
- `git add .`
- `git branch -M main`
- `git commit -m "Sync project and add updated .gitignore + README"`
- `git remote add origin https://github.com/lastra1/Haustap_Capstone.git`
- `git push -u origin main --force`

If authentication is required, use a Personal Access Token (PAT) with `repo` scope.

## Troubleshooting

- If pages don’t load, ensure you’re serving the correct directory and router, e.g. `router.php` for the nested web app.
- After pulling, run `composer install` (for PHP) and `npm install` (for JS) on each relevant project.
- Review `docs/environment-setup.md` for machine-specific setup notes.

## Notes

- This README is purely operational guidance. It does not modify any UI or UX.
