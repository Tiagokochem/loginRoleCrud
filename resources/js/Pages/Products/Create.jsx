import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Head, usePage } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/inertia-react';

export default function Create({ user }) {
  const { auth } = usePage().props;

  const [form, setForm] = useState({
    name: '',
    description: '',
    quantity: '',
    price: '',
    category: '',
    sku: '',
  });

  const handleChange = e => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = e => {
    e.preventDefault();
    Inertia.post('/api/v1/products', form);
  };

  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Novo Produto</h2>}
    >
      <Head title="Cadastrar Produto" />

      <div className="py-12">
        <div className="mx-auto max-w-3xl sm:px-6 lg:px-8">
          {/* Breadcrumb e voltar */}
          <div className="mb-6 flex items-center justify-between">
            <nav className="text-sm text-gray-500">
              <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
              <span className="mx-2">/</span>
              <Link href={route('products.index')} className="hover:underline">Produtos</Link>
              <span className="mx-2">/</span>
              <span className="text-gray-700 font-medium">Cadastrar</span>
            </nav>

            <Link
              href={route('products.index')}
              className="text-sm text-blue-600 hover:underline"
            >
              ← Voltar
            </Link>
          </div>

          {/* Formulário */}
          <div className="bg-white shadow rounded p-6">
            <form onSubmit={handleSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700">Nome</label>
                <input
                  name="name"
                  className="w-full border rounded p-2"
                  onChange={handleChange}
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea
                  name="description"
                  className="w-full border rounded p-2"
                  onChange={handleChange}
                ></textarea>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700">Quantidade</label>
                  <input
                    name="quantity"
                    type="number"
                    className="w-full border rounded p-2"
                    onChange={handleChange}
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Preço</label>
                  <input
                    name="price"
                    type="number"
                    className="w-full border rounded p-2"
                    onChange={handleChange}
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Categoria</label>
                  <input
                    name="category"
                    className="w-full border rounded p-2"
                    onChange={handleChange}
                  />
                </div>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">SKU</label>
                <input
                  name="sku"
                  className="w-full border rounded p-2"
                  onChange={handleChange}
                />
              </div>

              <div className="pt-4">
                <button
                  type="submit"
                  className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                  Cadastrar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
