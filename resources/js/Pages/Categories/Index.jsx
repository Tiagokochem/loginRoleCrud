import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';
import { Inertia } from '@inertiajs/inertia';

export default function Index({ categories }) {
  const { auth, flash } = usePage().props;

  const handleDelete = (id) => {
    if (confirm('Tem certeza que deseja excluir esta categoria?')) {
      Inertia.delete(route('categories.destroy', id));
    }
  };

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold text-gray-800">Categorias</h2>}
    >
      <Head title="Categorias" />

      <div className="py-8 max-w-4xl mx-auto">
        {/* Flash Message */}
        {flash?.success && (
          <div className="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded shadow">
            {flash.success}
          </div>
        )}

        {/* Breadcrumb e botão */}
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

        {/* Tabela */}
        <div className="bg-white shadow rounded">
          <table className="w-full table-auto">
            <thead>
              <tr className="bg-gray-100 text-left">
                <th className="px-6 py-3 text-sm font-medium text-gray-600">ID</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Nome</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600 text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              {categories?.map((cat, idx) => (
                <tr key={cat.id} className={idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'}>
                  <td className="px-6 py-3">{cat.id}</td>
                  <td className="px-6 py-3">{cat.name}</td>
                  <td className="px-6 py-3 text-right space-x-4">
                    <Link
                      href={route('categories.edit', cat.id)}
                      className="text-sm text-blue-600 hover:underline"
                    >
                      Editar
                    </Link>

                    <button
                      onClick={() => handleDelete(cat.id)}
                      className="text-sm text-red-600 hover:underline"
                    >
                      Excluir
                    </button>
                  </td>

                </tr>
              ))}
              {categories.length === 0 && (
                <tr>
                  <td colSpan="3" className="px-6 py-4 text-center text-gray-500">
                    Nenhuma categoria cadastrada.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
