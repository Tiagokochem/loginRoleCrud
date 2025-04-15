import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Head, usePage } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/inertia-react';

export default function Edit({ product, categories, user }) {
  const { auth } = usePage().props;

  const [form, setForm] = useState({
    name: product.name || '',
    description: product.description || '',
    quantity: product.quantity || '',
    price: product.price || '',
    sku: product.sku || '',
    category_id: product.category_id || '',
  });

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    Inertia.put(route('products.update', product.id), form);
  };

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold text-gray-800">Editar Produto</h2>}
    >
      <Head title="Editar Produto" />

      <div className="py-12">
        <div className="mx-auto max-w-3xl sm:px-6 lg:px-8">
          {/* Breadcrumb e voltar */}
          <div className="mb-6 flex items-center justify-between">
            <nav className="text-sm text-gray-500">
              <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
              <span className="mx-2">/</span>
              <Link href={route('products.index')} className="hover:underline">Produtos</Link>
              <span className="mx-2">/</span>
              <span className="text-gray-700 font-medium">Editar</span>
            </nav>

            <Link
              href={route('products.index')}
              className="text-sm text-blue-600 hover:underline"
            >
              ← Voltar
            </Link>
          </div>

          <div className="bg-white shadow rounded p-6">
            <form onSubmit={handleSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700">Nome</label>
                <input
                  name="name"
                  value={form.name}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea
                  name="description"
                  value={form.description}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                />
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700">Quantidade</label>
                  <input
                    name="quantity"
                    type="number"
                    value={form.quantity}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Preço</label>
                  <input
                    name="price"
                    type="number"
                    step="0.01"
                    value={form.price}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Categoria</label>
                  <select
                    name="category_id"
                    value={form.category_id}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  >
                    <option value="">Selecione...</option>
                    {categories.map(c => (
                      <option key={c.id} value={c.id}>{c.name}</option>
                    ))}
                  </select>
                </div>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">SKU</label>
                <input
                  name="sku"
                  value={form.sku}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                />
              </div>

              <div className="pt-4">
                <button
                  type="submit"
                  className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                  Salvar alterações
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
