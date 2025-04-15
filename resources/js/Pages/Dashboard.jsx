import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard({ auth, stats }) {
  return (
    <AuthenticatedLayout
      auth={auth}
      header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>}
    >
      <Head title="Dashboard" />

      <div className="py-12">
        <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div className="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
            <div className="rounded bg-white p-6 shadow">
              <h3 className="text-sm text-gray-500">Produtos cadastrados</h3>
              <p className="text-2xl font-bold">{stats.total}</p>
            </div>

            <div className="rounded bg-white p-6 shadow">
              <h3 className="text-sm text-gray-500">Quantidade total</h3>
              <p className="text-2xl font-bold">{stats.quantidade}</p>
            </div>

            <div className="rounded bg-white p-6 shadow">
              <h3 className="text-sm text-gray-500">Valor total estimado</h3>
              <p className="text-2xl font-bold">R$ {stats.valor.toFixed(2)}</p>
            </div>
          </div>

          <div className="space-x-4">
            <a
              href={route('products.index')}
              className="inline-block rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
            >
              Ver produtos
            </a>
            {auth.user.role === 'admin' && (
              <a
                href={route('products.create')}
                className="inline-block rounded bg-green-600 px-4 py-2 font-medium text-white hover:bg-green-700"
              >
                Novo produto
              </a>
            )}
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
