# LaravelBlogAppTest

Bu proje, temel bir Laravel blog uygulamasıdır.

## 🚀 Kurulum Adımları

Projeyi yerel makinenizde kurmak ve çalıştırmak için aşağıdaki adımları izleyin.

1.  **Projeyi klonlayın:**
    ```bash
    git clone [https://github.com/hdprogramming/LaravelBlogAppTest.git](https://github.com/hdprogramming/LaravelBlogAppTest.git)
    ```

2.  **Proje dizinine gidin:**
    ```bash
    cd LaravelBlogAppTest
    ```

3.  **Composer bağımlılıklarını yükleyin (PHP):**
    ```bash
    composer install
    ```

4.  **.env (Ortam değişkenleri) dosyasını oluşturun:**
    ```bash
    cp .env.example .env
    ```

5.  **.env dosyasını yapılandırın:**
    Oluşturduğunuz `.env` dosyasını bir kod editörü ile açın ve özellikle aşağıdaki veritabanı ayarlarını kendi yerel ortamınıza göre güncelleyin:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_blog_test_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *(Not: `DB_DATABASE` için yerelinizde yeni bir veritabanı oluşturduğunuzdan emin olun.)*

6.  **Uygulama anahtarını (APP_KEY) oluşturun:**
    ```bash
    php artisan key:generate
    ```

7.  **Veritabanı tablolarını oluşturun (Migrate):**
    ```bash
    php artisan migrate
    ```

8.  **(Opsiyonel) Veritabanını başlangıç verileriyle doldurun (Seed):**
    ```bash
    php artisan db:seed
    ```

9.  **NPM bağımlılıklarını yükleyin (Frontend):**
    ```bash
    npm install
    ```

10. **Varlıkları (Assets) derleyin (CSS/JS):**
    ```bash
    npm run build
    ```

11. **Yerel sunucuyu başlatın:**
    ```bash
    php artisan serve
    ```

12. **Uygulamaya erişin:**
    Projeniz artık [http://127.0.0.1:8000](http://127.0.0.1:8000) adresinde çalışıyor olacaktır.

---

## 📄 Lisans

Bu proje [MIT lisansı](https://opensource.org/licenses/MIT) ile lisanslanmıştır.
