## Tentang PPDB
PPDB adalah aplikasi manajemen penerimaan siswa baru berbasis website yang di bangun dan di kembangkan dengan Framework Laravel.

## HAK CIPTA, SYARAT, DAN KETENTUAN
Sistem PPDB ini dikelola dengan merujuk pada lisensi **GNU General Public License Version 3** (http://www.gnu.org/licenses/gpl.html).

**Versi di GitHub ini dikembangkan sejak September 2023, gratis dan bebas untuk dimanfaatkan dan dikembangkan oleh semua sekolah.

## Cara Install
	- git clone .....
	- cd vote
    - composer install
	- cp .env.example .env
    - php artisan key:generate
    - Kuncinya akan ditulis secara otomatis di file .env Anda.
## Database
    - buat database ppdb
    - php artisan storage:link
## Running Seeders
    - php artisan migrate --seed
    - atau
    - php artisan migrate:refresh --seed
## Database Config
    - config/database.php
```
    edit .env
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ppdb
    DB_USERNAME=root
    DB_PASSWORD=
```

# Node
####node Version
#node -> stable (-> v18.14.0)