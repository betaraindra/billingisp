import React, { useEffect, useState } from 'react';
import { FileText, Download, Send, CheckCircle, AlertCircle, Clock } from 'lucide-react';

interface Invoice {
  id: number;
  customer_name: string;
  amount: number;
  status: 'paid' | 'unpaid' | 'overdue';
  due_date: string;
  created_at: string;
}

export default function Billing() {
  const [invoices, setInvoices] = useState<Invoice[]>([]);

  useEffect(() => {
    fetch('/api/invoices')
      .then(res => res.json())
      .then(data => setInvoices(data))
      .catch(err => console.error('Failed to fetch invoices:', err));
  }, []);

  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'paid':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800"><CheckCircle className="w-3 h-3 mr-1" /> Paid</span>;
      case 'overdue':
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"><AlertCircle className="w-3 h-3 mr-1" /> Overdue</span>;
      default:
        return <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><Clock className="w-3 h-3 mr-1" /> Unpaid</span>;
    }
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-slate-900">Billing & Invoices</h1>
        <button className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
          <FileText className="h-4 w-4 mr-2" />
          Generate Invoice
        </button>
      </div>

      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-4">Invoice ID</th>
              <th className="px-6 py-4">Customer</th>
              <th className="px-6 py-4">Amount</th>
              <th className="px-6 py-4">Due Date</th>
              <th className="px-6 py-4">Status</th>
              <th className="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {invoices.map((invoice) => (
              <tr key={invoice.id} className="hover:bg-slate-50 transition-colors">
                <td className="px-6 py-4 font-mono text-slate-500">#{invoice.id.toString().padStart(6, '0')}</td>
                <td className="px-6 py-4 font-medium text-slate-900">{invoice.customer_name}</td>
                <td className="px-6 py-4">Rp {invoice.amount.toLocaleString('id-ID')}</td>
                <td className="px-6 py-4">{new Date(invoice.due_date).toLocaleDateString()}</td>
                <td className="px-6 py-4">{getStatusBadge(invoice.status)}</td>
                <td className="px-6 py-4 text-right space-x-2">
                  <button className="text-slate-400 hover:text-indigo-600" title="Download PDF">
                    <Download className="h-4 w-4" />
                  </button>
                  <button className="text-slate-400 hover:text-emerald-600" title="Send via WhatsApp">
                    <Send className="h-4 w-4" />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
