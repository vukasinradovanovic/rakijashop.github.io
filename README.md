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

## Dokumentacija sajta

### Kako radi login korisnika

Korisnik se prijavljuje preko forme za login unosom:

- `email`
- `password`

Autentikacija se radi preko Laravel mehanizma `Auth::attempt` i podrzan je `remember me` checkbox.

Napomena:

- Login se radi preko email adrese (ne preko username vrednosti).
- Posle uspesnog logina radi se regeneracija sesije (`$request->session()->regenerate()`) radi bezbednosti.

### Test kredencijali (nakon `php artisan db:seed`)

Seeder `UserSeeder` kreira sledece korisnike:

| Uloga | Email | Lozinka |
| --- | --- | --- |
| Admin | `admin@example.com` | `admin123` |
| Moderator | `manager@example.com` | `manager123` |
| Korisnik | `user@example.com` | `user12345` |

Seeder `UserRoleSeeder` mapira ove korisnike na role iz `RolesSeeder` (`admin`, `moderator`, `korisnik`).

### Registracija

- Novi korisnik se registruje sa: ime, email i lozinka.
- Username se automatski generise u formatu `user_xxxxxxxxxx`.
- Default rola za registrovanog korisnika je `korisnik`.

### Funkcionalnosti sajta

Glavne funkcionalnosti aplikacije:

1. Katalog proizvoda
- Lista proizvoda, detalj proizvoda i prikaz osnovnih informacija (slika, naziv, cena, opis, autor).

2. Korpa
- Dodavanje proizvoda u korpu.
- Izmena kolicine u korpi.
- Brisanje proizvoda iz korpe.

3. Korisnicki nalozi
- Registracija i login korisnika.
- Logout korisnika.
- Pregled korisnickog profila.
- Izmena podataka profila (ime, username, email).
- Promena lozinke kroz posebnu formu na stranici za izmenu profila.

4. Kontakt forma
- Slanje poruka preko kontakt stranice.

5. Admin dashboard (za admin korisnike)
- Upravljanje korisnicima.
- Upravljanje proizvodima.
- Upravljanje kategorijama proizvoda.
- Pregled poruka/pitanja korisnika.
- Pregled sistemskih gresaka na posebnoj dashboard errors stranici.

6. Lokalizacija
- Aplikacija podrzava jezike `sr` i `en` kroz locale prefiks u URL-u (`/{locale}/...`).

7. Frontend build
- Frontend asseti se grade preko Vite-a (`npm run dev` / `npm run build`).

### Kratak flow za proveru svega lokalno

1. Pokreni:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
composer run dev
```

2. Otvori aplikaciju i prijavi se nekim od test naloga iz tabele iznad.

3. Testiraj:

- pregled proizvoda i detalja,
- korpu,
- izmenu profila,
- promenu lozinke,
- dashboard (sa admin nalogom).
