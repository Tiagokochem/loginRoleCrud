import React from 'react';
import { Head, useForm, usePage, Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Create({ user, categories }) {
  const { auth } = usePage().props;

  const {
    data,
    setData,
    post,
    processing,
    errors,
    reset,
  } = useForm({
    name: '',
    description: '',
    quantity: '',
    price: '',
    category_id: '',
    sku: '',
  });

  const handleChange = (e) => {
    setData(e.target.name, e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('products.store'), {
      onSuccess: () => reset(),
    });
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

          <div className="bg-white shadow rounded p-6">
            <form onSubmit={handleSubmit} className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-700">Nome</label>
                <input
                  name="name"
                  value={data.name}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                />
                {errors.name && <p className="text-red-600 text-sm">{errors.name}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea
                  name="description"
                  value={data.description}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                ></textarea>
                {errors.description && <p className="text-red-600 text-sm">{errors.description}</p>}
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700">Quantidade</label>
                  <input
                    name="quantity"
                    type="number"
                    value={data.quantity}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  />
                  {errors.quantity && <p className="text-red-600 text-sm">{errors.quantity}</p>}
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Preço</label>
                  <input
                    name="price"
                    type="number"
                    value={data.price}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  />
                  {errors.price && <p className="text-red-600 text-sm">{errors.price}</p>}
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700">Categoria</label>
                  <select
                    name="category_id"
                    value={data.category_id}
                    onChange={handleChange}
                    className="w-full border rounded p-2"
                  >
                    <option value="">Selecione...</option>
                    {categories.map((c) => (
                      <option key={c.id} value={c.id}>
                        {c.name}
                      </option>
                    ))}
                  </select>
                  {errors.category_id && <p className="text-red-600 text-sm">{errors.category_id}</p>}
                </div>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">SKU</label>
                <input
                  name="sku"
                  value={data.sku}
                  onChange={handleChange}
                  className="w-full border rounded p-2"
                />
                {errors.sku && <p className="text-red-600 text-sm">{errors.sku}</p>}
              </div>

              <div className="pt-4">
                <button
                  type="submit"
                  disabled={processing}
                  className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
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
