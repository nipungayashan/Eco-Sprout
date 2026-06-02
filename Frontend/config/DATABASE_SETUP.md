# EcoSprout — Database setup (phpMyAdmin & MySQL Workbench)

## Files in `config/`

| File | Purpose |
|------|---------|
| `schema.sql` | Creates all tables (structure only) |
| `sample_data.sql` | Inserts test users, plants, tools, orders, etc. |
| `install_fresh.sql` | Drops database (optional clean start) |
| `db.php` | PHP connection (already in project) |

---

## Table map (which page uses which table)

| Website area | PHP pages | MySQL table(s) |
|--------------|-----------|----------------|
| **Login / Register** | `auth/login.php`, `auth/register.php` | `users` |
| **Admin dashboard** | `admin/index.php`, `admin/users.php` | `users`, `shop_orders` (stats) |
| **Admin reports** | `admin/reports.php` | `shop_orders`, `shop_order_items`, `plants`, `tools` |
| **Catalogue** | `catalogue.php`, `plant.php` | `plants` |
| **Tools shop** | `tools.php`, `cart.php` | `tools` |
| **Services** | `services.php` | `services` |
| **Workshops** | `workshops.php` | `workshops` |
| **Checkout / Orders** | `checkout.php`, `customer/orders.php` | `shop_orders`, `shop_order_items` |
| **Customer dashboard** | `customer/dashboard.php` | `shop_orders`, `bookings` |
| **Customer bookings** | `customer/bookings.php` | `bookings`, `services`, `workshops` |
| **Contact / Queries** | `contact.php`, `staff/queries.php` | `customer_queries` |
| **Staff CRUD** | `staff/plants.php`, `tools.php`, etc. | `plants`, `tools`, `services`, `workshops` |
| **Blog** | `blog.php`, `article.php` | `blog_articles` |
| **Newsletter** | `index.php` (home) | `newsletter_subscribers` |

---

## phpMyAdmin — step by step

1. Start **WAMP** (green icon).
2. Open **http://localhost/phpmyadmin**
3. Click **SQL** tab.
4. **First time or clean rebuild:**
   - Run: `DROP DATABASE IF EXISTS ecosprout;`
   - Or run contents of `install_fresh.sql`
5. Copy all of **`schema.sql`** → paste → **Go**
6. Copy all of **`sample_data.sql`** → paste → **Go**
7. Left sidebar: click **ecosprout** — you should see **11 tables**.

### Test logins (from sample data)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@ecosprout.com | Admin123 |
| Staff | staff@ecosprout.com | Staff123 |
| Customer | customer@ecosprout.com | Customer123 |

---

## MySQL Workbench — step by step

1. Open **MySQL Workbench**.
2. Connect to **Local instance MySQL** (user: `root`, password: usually empty).
3. **File → Open SQL Script** → select `schema.sql` → execute (⚡).
4. **File → Open SQL Script** → select `sample_data.sql` → execute (⚡).
5. Refresh **Schemas** → expand **ecosprout** → **Tables**.

---

## All tables (quick reference)

```sql
USE ecosprout;
SHOW TABLES;
```

Expected tables:

1. `users`
2. `plants`
3. `tools`
4. `services`
5. `workshops`
6. `shop_orders`
7. `shop_order_items`
8. `bookings`
9. `customer_queries`
10. `blog_articles`
11. `newsletter_subscribers`

---

## Useful SQL checks

```sql
USE ecosprout;

SELECT * FROM users;
SELECT * FROM plants;
SELECT * FROM tools;
SELECT * FROM services;
SELECT * FROM workshops;
SELECT * FROM shop_orders;
SELECT * FROM shop_order_items;
SELECT * FROM bookings;
SELECT * FROM customer_queries;
```

---

## If tables already exist (add only new ones)

If you already ran an older `schema.sql` with only `users` and `plants`:

1. Run **only** the new `CREATE TABLE IF NOT EXISTS` blocks from `schema.sql` (tools through newsletter_subscribers).
2. Run `sample_data.sql` — skip duplicate user errors if users already exist.

---

## PHP connection

`Frontend/config/db.php` must match WAMP:

- Host: `localhost`
- Database: `ecosprout`
- User: `root`
- Password: `` (empty)

Site URL: **http://localhost/EcoSprout/Frontend/index.php**
