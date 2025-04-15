import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { Link } from '@inertiajs/inertia-react';

export default function Create() {
    const { auth } = usePage().props;
    const { errors } = usePage().props;
    const [name, setName] = useState('');

    const handleSubmit = e => {
        e.preventDefault();
        Inertia.post(route('categories.store'), { name });
    };

    return (
        <AuthenticatedLayout
            auth={auth}
            header={<h2 className="text-xl font-semibold text-gray-800">Nova Categoria</h2>}
        >
            <Head title="Nova Categoria" />

            <div className="py-8 max-w-xl mx-auto">
                <div className="flex justify-between mb-4">
                    <nav className="text-sm text-gray-500">
                        <Link href={route('dashboard')} className="hover:underline">Dashboard</Link>
                        <span className="mx-2">/</span>
                        <Link href={route('categories.index')} className="hover:underline">Categorias</Link>
                        <span className="mx-2">/</span>
                        <span>Nova</span>
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
                                name="name"
                                value={name}
                                onChange={e => setName(e.target.value)}
                                className={`w-full border rounded p-2 ${errors.name ? 'border-red-500' : 'border-gray-300'}`}
                            />
                            {errors.name && (
                                <p className="text-sm text-red-600 mt-1">{errors.name}</p>
                            )}

                        </div>

                        <button
                            type="submit"
                            className="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                        >
                            Cadastrar
                        </button>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
