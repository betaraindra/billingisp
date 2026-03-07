import Database from 'better-sqlite3';
import path from 'path';
import fs from 'fs';

// Ensure the data directory exists
const dataDir = path.join(process.cwd(), 'data');
if (!fs.existsSync(dataDir)) {
  fs.mkdirSync(dataDir);
}

const dbPath = path.join(dataDir, 'isp_billing.db');
const db = new Database(dbPath);

// Initialize tables
db.exec(`
  CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'admin',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );

  CREATE TABLE IF NOT EXISTS packages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    speed TEXT NOT NULL,
    price INTEGER NOT NULL,
    bandwidth_limit TEXT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );

  CREATE TABLE IF NOT EXISTS customers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    address TEXT,
    phone TEXT,
    email TEXT,
    status TEXT DEFAULT 'active', -- active, suspended, inactive
    package_id INTEGER,
    latitude REAL,
    longitude REAL,
    installation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (package_id) REFERENCES packages(id)
  );

  CREATE TABLE IF NOT EXISTS routers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    ip_address TEXT NOT NULL,
    status TEXT DEFAULT 'online', -- online, offline
    location TEXT,
    last_seen DATETIME DEFAULT CURRENT_TIMESTAMP
  );

  CREATE TABLE IF NOT EXISTS invoices (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    customer_id INTEGER NOT NULL,
    amount INTEGER NOT NULL,
    status TEXT DEFAULT 'unpaid', -- unpaid, paid, overdue
    due_date DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
  );

  CREATE TABLE IF NOT EXISTS payments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    invoice_id INTEGER NOT NULL,
    amount INTEGER NOT NULL,
    method TEXT NOT NULL, -- transfer, cash, qris
    transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id)
  );
`);

// Seed initial data if empty
const userCount = db.prepare('SELECT count(*) as count FROM users').get() as { count: number };
if (userCount.count === 0) {
  console.log('Seeding database...');
  
  // Seed Users
  const insertUser = db.prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
  insertUser.run('admin', 'admin123', 'super_admin');
  insertUser.run('teknisi', 'teknisi123', 'technician');
  insertUser.run('kasir', 'kasir123', 'cashier');

  // Seed Packages
  const insertPackage = db.prepare('INSERT INTO packages (name, speed, price, bandwidth_limit) VALUES (?, ?, ?, ?)');
  insertPackage.run('Home Basic', '10 Mbps', 150000, 'Unlimited');
  insertPackage.run('Home Pro', '20 Mbps', 250000, 'Unlimited');
  insertPackage.run('Business Elite', '50 Mbps', 500000, 'Unlimited');

  // Seed Customers
  const insertCustomer = db.prepare('INSERT INTO customers (name, address, phone, email, status, package_id, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
  insertCustomer.run('John Doe', 'Jl. Merdeka No. 1', '081234567890', 'john@example.com', 'active', 2, -6.200000, 106.816666);
  insertCustomer.run('Jane Smith', 'Jl. Sudirman No. 45', '081987654321', 'jane@example.com', 'suspended', 1, -6.210000, 106.820000);
  insertCustomer.run('Budi Santoso', 'Jl. Thamrin No. 10', '081223344556', 'budi@example.com', 'active', 3, -6.190000, 106.830000);

  // Seed Routers
  const insertRouter = db.prepare('INSERT INTO routers (name, ip_address, status, location) VALUES (?, ?, ?, ?)');
  insertRouter.run('Core Router 1', '192.168.1.1', 'online', 'Server Room A');
  insertRouter.run('Distribution Switch 1', '192.168.2.1', 'online', 'Cluster B');
  insertRouter.run('Access Point 5', '192.168.3.5', 'offline', 'Cluster C');

  // Seed Invoices
  const insertInvoice = db.prepare('INSERT INTO invoices (customer_id, amount, status, due_date, created_at) VALUES (?, ?, ?, ?, ?)');
  const today = new Date();
  const lastMonth = new Date(today);
  lastMonth.setMonth(today.getMonth() - 1);
  
  insertInvoice.run(1, 250000, 'paid', lastMonth.toISOString(), lastMonth.toISOString());
  insertInvoice.run(2, 150000, 'overdue', lastMonth.toISOString(), lastMonth.toISOString());
  insertInvoice.run(3, 500000, 'unpaid', today.toISOString(), today.toISOString());

  console.log('Database seeded successfully.');
}

export default db;
