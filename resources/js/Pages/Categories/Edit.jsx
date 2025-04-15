import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Edit({ category, user }) {
  const { auth } = usePage().props;

  const [name, setName] = useState(category.name || '');

  const handleSubmit = (e) => {
    e.preventDefault();
    Inertia.put(route('categories.update', category.id), { name });
  };

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold text-gray-800">Editar Categoria</h2>}
    >
      <Head title="Editar Categoria" />

      <div className="py-8 max-w-xl mx-auto">
        <div className="flex justify-between mb-4">
          <nav className="text-sm text-gray-500">
            <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
            <span className="mx-2">/</span>
            <Link href={route('categories.index')} className="hover:underline">Categorias</Link>
            <span className="mx-2">/</span>
            <span>Editar</span>
          </nav>

          <Link
            href={route('categories.index')}
            className="text-sm text-blue-600 hover:underline"
          >
            ← Voltar
          </Link>
        </div>

        <div className="bg-white p-6 rounded shadow">
          <form onSubmit={handleSubmit} className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700">Nome da categoria</label>
              <input
                type="text"
                value={name}
                onChange={(e) => setName(e.target.value)}
                className="w-full border rounded p-2"
              />
            </div>

            <button
              type="submit"
              className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
              Salvar Alterações
            </button>
          </form>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
