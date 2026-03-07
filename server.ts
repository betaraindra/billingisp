import express from 'express';
import { createServer as createViteServer } from 'vite';
import db from './src/server/db.ts';

async function startServer() {
  const app = express();
  const PORT = 3000;

  app.use(express.json());

  // API Routes
  
  // Dashboard Stats
  app.get('/api/dashboard/stats', (req, res) => {
    try {
      const totalCustomers = db.prepare("SELECT count(*) as count FROM customers").get() as { count: number };
      const activeCustomers = db.prepare("SELECT count(*) as count FROM customers WHERE status = 'active'").get() as { count: number };
      const suspendedCustomers = db.prepare("SELECT count(*) as count FROM customers WHERE status = 'suspended'").get() as { count: number };
      const overdueInvoices = db.prepare("SELECT count(*) as count FROM invoices WHERE status = 'overdue'").get() as { count: number };
      
      // Monthly Revenue (simple sum of paid invoices for current month - simplified for demo)
      const revenue = db.prepare("SELECT sum(amount) as total FROM invoices WHERE status = 'paid'").get() as { total: number };

      res.json({
        totalCustomers: totalCustomers.count,
        activeCustomers: activeCustomers.count,
        suspendedCustomers: suspendedCustomers.count,
        overdueInvoices: overdueInvoices.count,
        revenue: revenue.total || 0
      });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  });

  // Customers API
  app.get('/api/customers', (req, res) => {
    const customers = db.prepare(`
      SELECT c.*, p.name as package_name, p.price as package_price 
      FROM customers c 
      LEFT JOIN packages p ON c.package_id = p.id
    `).all();
    res.json(customers);
  });

  app.post('/api/customers', (req, res) => {
    const { name, address, phone, email, package_id } = req.body;
    const stmt = db.prepare('INSERT INTO customers (name, address, phone, email, package_id) VALUES (?, ?, ?, ?, ?)');
    const info = stmt.run(name, address, phone, email, package_id);
    res.json({ id: info.lastInsertRowid });
  });

  // Packages API
  app.get('/api/packages', (req, res) => {
    const packages = db.prepare('SELECT * FROM packages').all();
    res.json(packages);
  });

  // Invoices API
  app.get('/api/invoices', (req, res) => {
    const invoices = db.prepare(`
      SELECT i.*, c.name as customer_name 
      FROM invoices i 
      JOIN customers c ON i.customer_id = c.id
      ORDER BY i.created_at DESC
    `).all();
    res.json(invoices);
  });

  // Routers API
  app.get('/api/routers', (req, res) => {
    const routers = db.prepare('SELECT * FROM routers').all();
    res.json(routers);
  });


  // Vite middleware for development
  if (process.env.NODE_ENV !== 'production') {
    const vite = await createViteServer({
      server: { middlewareMode: true },
      appType: 'spa',
    });
    app.use(vite.middlewares);
  } else {
    // Serve static files in production (if needed, though this is dev env)
    app.use(express.static('dist'));
  }

  app.listen(PORT, '0.0.0.0', () => {
    console.log(`Server running on http://localhost:${PORT}`);
  });
}

startServer();
