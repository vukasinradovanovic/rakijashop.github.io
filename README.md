# Rakija Shop - Pokretanje projekta

Ovaj dokument opisuje sve potrebne korake da pokrenes projekat lokalno nakon kloniranja sa udaljenog repozitorijuma.

## 1. Preduslovi

Instaliraj sledece alate:

- PHP 8.2+
- Composer 2+
- Node.js 18+ i npm
- Baza (MySQL)
- Git

Provera verzija:

```bash
php -v
composer -V
node -v
npm -v
```

## 2. Kloniranje repozitorijuma

```bash
git clone https://github.com/vukasinradovanovic/rakijashop.github.io.git
cd rakijashop.github.io
```

Ako koristis drugaciji remote URL, zameni ga svojim URL-om.

## 3. Instalacija backend zavisnosti

```bash
composer install
```

## 4. Instalacija frontend zavisnosti

```bash
npm install
```

## 5. Konfiguracija okruzenja (.env)

Ako .env ne postoji, napravi ga iz template fajla:

```bash
cp .env.example .env
```

Na Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Zatim podesi vrednosti u `.env`, najmanje:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

## 6. Generisanje app kljuca

```bash
php artisan key:generate
```

## 7. Baza i migracije

Pokreni migracije:

```bash
php artisan migrate
```

Ako projekat koristi seedere i zelis testne/pocetne podatke:

```bash
php artisan db:seed
```

Ako zelis sve iz pocetka (oprez, brise podatke):

```bash
php artisan migrate:fresh --seed
```

## 8. Storage link

Pošto se fajlovi smeštaju u `storage/app/public`, napravi simbolicki link:

```bash
php artisan storage:link
```

## 9. Pokretanje projekta

### Opcija A - odvojeni terminali

Terminal 1 (Laravel server):

```bash
php artisan serve
```

Terminal 2 (Vite dev server):

```bash
npm run dev
```

### Opcija B - jednim komandnim pozivom (composer script)

```bash
composer run dev
```

Ova komanda paralelno pokrece server, queue listener, log watcher i Vite.

## 10. Build za produkciju

```bash
npm run build
```

## 11. Testovi

```bash
php artisan test
```

## Ceste greske

- `Class ... not found`: pokreni `composer dump-autoload`.
- `Vite manifest not found`: pokreni `npm run build` ili `npm run dev`.
- `No application encryption key has been specified`: pokreni `php artisan key:generate`.
- DB greske: proveri `.env` i da li je baza kreirana.
