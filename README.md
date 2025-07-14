#  Crypto Tracker (Symfony + Docker)

A real-time-like REST API that fetches cryptocurrency data from the [CoinGecko API](https://www.coingecko.com/en/api), stores it in a PostgreSQL database, and exposes it via Symfony API Platform.

---

##  Tech Stack

- Symfony 6
- PHP 8.2+
- PostgreSQL 15
- Docker & Docker Compose
- API Platform
- CoinGecko External API
- Cron (Linux job scheduler)
- Symfony Console Command

---

## ⚙ Installation (with Docker)

```bash
git clone https://github.com/USERNAME/crypto-tracker.git
cd crypto-tracker
```
Start Docker containers:
```bash
docker compose up -d --build
```
Install PHP dependencies:
```bash
docker exec symfony_app composer install
```

Run database migrations:
```bash
docker exec symfony_app php bin/console doctrine:migrations:migrate
```
🛰️ Fetch Data Manually (Optional)
You can manually fetch and save crypto data from the CoinGecko API with the following command:

```bash
docker exec symfony_app php bin/console app:fetch-crypto
```
This will:
Fetch market data in USD from the CoinGecko API

Insert or update the CryptoCurrency table in the database

Log any errors to var/log/dev.log using the Symfony logger

⏱Automatic Updates via Cron
To automatically update crypto data every minute:

1. Make sure cron is installed and running (on host machine):
```bash
sudo dnf install cronie          # Fedora-based systems
sudo systemctl enable --now crond
```
2. Add cron task:
```bash
crontab -e
```
Paste this line:

```bash
* * * * * docker exec symfony_app php bin/console app:fetch-crypto >> /dev/null 2>&1
```
Now your crypto data will refresh every minute 🚀

🔍 API Endpoint (via API Platform)
You can access the list of cryptocurrencies using:

GET http://localhost:8080/api/crypto_currencies
Each record contains:

id

symbol

name

price

change24h

marketCap

volume24h

fetchedAt

Developer CLI Commands
php bin/console app:fetch-crypto – fetch and store data from API

php bin/console doctrine:migrations:migrate – run database migrations

composer install – install PHP dependencies
