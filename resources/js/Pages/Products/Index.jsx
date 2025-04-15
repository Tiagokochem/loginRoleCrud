import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function ProductsIndex({ products, user }) {
  const { auth } = usePage().props;

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Produtos</h2>}
    >
      <Head title="Produtos" />

      <div className="py-12">
        <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div className="mb-6 flex items-center justify-between">
            <nav className="text-sm text-gray-500">
              <Link href={route('dashboard')} className="hover:underline">
                Dashboard
              </Link>
              <span className="mx-2">/</span>
              <span className="text-gray-700 font-medium">Produtos</span>
            </nav>

            <Link
              href={route('dashboard')}
              className="text-sm text-blue-600 hover:underline"
            >
              ← Voltar
            </Link>
          </div>

          {user.role === 'admin' && (
            <div className="mb-4">
              <Link
                href={route('products.create')}
                className="inline-block rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700"
              >
                Novo Produto
              </Link>
            </div>
          )}

          <div className="overflow-x-auto bg-white shadow rounded">
            <table className="w-full table-auto">
              <thead>
                <tr className="bg-gray-100 text-left">
                  <th className="px-6 py-3 text-sm font-medium text-gray-600">Nome</th>
                  <th className="px-6 py-3 text-sm font-medium text-gray-600">Categoria</th>
                  <th className="px-6 py-3 text-sm font-medium text-gray-600">Preço</th>
                  <th className="px-6 py-3 text-sm font-medium text-gray-600">Qtd</th>
                  <th className="px-6 py-3 text-sm font-medium text-gray-600">SKU</th>
                </tr>
              </thead>
              <tbody>
                {products.map((prod, idx) => (
                  <tr key={prod.id} className={idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'}>
                    <td className="px-6 py-3">{prod.name}</td>
                    <td className="px-6 py-3">{prod.category}</td>
                    <td className="px-6 py-3">R$ {prod.price ? Number(prod.price).toFixed(2) : '0.00'}</td>
                    <td className="px-6 py-3">{prod.quantity}</td>
                    <td className="px-6 py-3">{prod.sku}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
