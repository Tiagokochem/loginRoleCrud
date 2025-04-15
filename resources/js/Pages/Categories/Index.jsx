import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link, usePage, Head } from '@inertiajs/react';

export default function Index({ categories }) {
  const { auth, flash } = usePage().props;

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold text-gray-800">Categorias</h2>}
    >
      <Head title="Categorias" />

      <div className="py-8 max-w-4xl mx-auto">
        {flash?.success && (
          <div className="mb-4 bg-green-100 text-green-800 p-3 rounded">
            {flash.success}
          </div>
        )}

        <div className="flex justify-between mb-4">
          <nav className="text-sm text-gray-500">
            <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
            <span className="mx-2">/</span>
            <span className="text-gray-700">Categorias</span>
          </nav>

          <Link
            href={route('categories.create')}
            className="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
          >
            Nova Categoria
          </Link>
        </div>

        <div className="bg-white shadow rounded">
          <table className="w-full table-auto">
            <thead>
              <tr className="bg-gray-100 text-left">
                <th className="px-6 py-3 text-sm font-medium text-gray-600">ID</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Nome</th>
              </tr>
            </thead>
            <tbody>
              {categories?.map((cat, idx) => (
                <tr key={cat.id} className={idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'}>
                  <td className="px-6 py-3">{cat.id}</td>
                  <td className="px-6 py-3">{cat.name}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
