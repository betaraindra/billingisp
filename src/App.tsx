import React from 'react';
import { HashRouter, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './components/Layout';
import Dashboard from './pages/Dashboard';
import Customers from './pages/Customers';
import Billing from './pages/Billing';
import Services from './pages/Services';

import Network from './pages/Network';

import NOC from './pages/NOC';

import Tools from './pages/Tools';

import Settings from './pages/Settings';

import Users from './pages/Users';

import WhatsApp from './pages/WhatsApp';

import Portal from './pages/Portal';

import Notifications from './pages/Notifications';
import Reports from './pages/Reports';

import Payments from './pages/Payments';

export default function App() {
  return (
    <HashRouter>
      <Layout>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/customers" element={<Customers />} />
          <Route path="/billing" element={<Billing />} />
          <Route path="/payments" element={<Payments />} />
          <Route path="/services" element={<Services />} />
          <Route path="/network" element={<Network />} />
          <Route path="/noc" element={<NOC />} />
          <Route path="/tools" element={<Tools />} />
          <Route path="/settings" element={<Settings />} />
          <Route path="/users" element={<Users />} />
          <Route path="/whatsapp" element={<WhatsApp />} />
          <Route path="/portal" element={<Portal />} />
          <Route path="/notifications" element={<Notifications />} />
          <Route path="/reports" element={<Reports />} />
          <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
      </Layout>
    </HashRouter>
  );
}
