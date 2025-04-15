import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage, Link } from '@inertiajs/react';

export default function ProductsIndex({ products, user }) {
console.log(products);
  const { auth, flash } = usePage().props;

  const handleDelete = (id) => {
    if (confirm('Tem certeza que deseja excluir este produto?')) {
      Inertia.delete(route('products.destroy', id));
    }
  };

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold text-gray-800">Produtos</h2>}
    >
      <Head title="Produtos" />

      <div className="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {flash?.success && (
          <div className="mb-4 bg-green-100 text-green-800 border border-green-400 px-4 py-3 rounded shadow">
            {flash.success}
          </div>
        )}

        <div className="flex justify-between mb-4">
          <nav className="text-sm text-gray-500">
            <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
            <span className="mx-2">/</span>
            <span className="text-gray-700">Produtos</span>
          </nav>

          {user.role === 'admin' && (
            <Link
              href={route('products.create')}
              className="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
            >
              Novo Produto
            </Link>
          )}
        </div>

        <div className="bg-white shadow rounded overflow-x-auto">
          <table className="w-full table-auto">
            <thead>
              <tr className="bg-gray-100 text-left">
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Nome</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Categoria</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Preço</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">Qtd</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600">SKU</th>
                <th className="px-6 py-3 text-sm font-medium text-gray-600 text-right">Ações</th>
              </tr>
            </thead>
            <tbody>
              {products.map((prod, idx) => (
                <tr key={prod.id} className={idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'}>
                  <td className="px-6 py-3">{prod.name}</td>
                  <td className="px-6 py-3">{prod.category_name || '-'}</td>
                  <td className="px-6 py-3">
                    R$ {Number(prod.price || 0).toFixed(2)}
                  </td>                  <td className="px-6 py-3">{prod.quantity}</td>
                  <td className="px-6 py-3">{prod.sku}</td>
                  <td className="px-6 py-3 text-right space-x-4">
  {user.role === 'admin' && (
    <>
      <Link
        href={route('products.edit', prod.id)}
        className="text-sm text-blue-600 hover:underline"
      >
        Editar
      </Link>
      <button
        onClick={() => handleDelete(prod.id)}
        className="text-sm text-red-600 hover:underline"
      >
        Excluir
      </button>
    </>
  )}
</td>

                </tr>
              ))}
              {products.length === 0 && (
                <tr>
                  <td colSpan="6" className="px-6 py-4 text-center text-gray-500">
                    Nenhum produto cadastrado.
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
