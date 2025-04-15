import React from 'react';
import { Head, Link } from '@inertiajs/react';

export default function Welcome({ auth }) {
  return (
    <>
      <Head title="Sistema de Controle de Estoque" />

      <div className="min-h-screen bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900 text-white p-8">
        <div className="max-w-5xl mx-auto">
          <header className="flex justify-between items-center mb-12">
            <h1 className="text-4xl font-extrabold tracking-tight">📦 Sistema de Estoque</h1>
            <nav className="space-x-6">
              {auth?.user ? (
                <Link href="/dashboard" className="hover:underline text-blue-400">Dashboard</Link>
              ) : (
                <>
                  <Link href="/login" className="hover:underline text-blue-400">Entrar</Link>
                  <Link href="/register" className="hover:underline text-green-400">Registrar</Link>
                </>
              )}
            </nav>
          </header>

          <section className="bg-gray-800 p-6 rounded-lg shadow-lg mb-12">
            <h2 className="text-2xl font-bold mb-4">Sobre o Projeto</h2>
            <p className="text-gray-300 mb-2">
              Este sistema foi desenvolvido com Laravel 12 e React + Inertia.js, incluindo autenticação JWT, ACL, Swagger para documentação da API e testes automatizados.
            </p>
            <p className="text-gray-300">
              Ele permite o controle completo de produtos, categorias e usuários com diferentes níveis de acesso, além de cache otimizado, filtros avançados e visualização em tempo real de dados do estoque.
            </p>
          </section>

          <section className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div className="bg-gray-700 p-6 rounded-lg shadow-md">
              <h3 className="text-lg font-bold mb-2">🧩 Tecnologias</h3>
              <ul className="list-disc list-inside text-sm text-gray-300">
                <li>Laravel 10 + Breeze</li>
                <li>React.js + Inertia.js</li>
                <li>TailwindCSS</li>
                <li>JWT Auth</li>
                <li>Swagger (L5)</li>
                <li>Docker + Sail</li>
              </ul>
            </div>

            <div className="bg-gray-700 p-6 rounded-lg shadow-md">
              <h3 className="text-lg font-bold mb-2">🧪 Testes</h3>
              <ul className="list-disc list-inside text-sm text-gray-300">
                <li>Testes de autenticação</li>
                <li>Testes de API (Produto & Categoria)</li>
                <li>Validação de acesso por roles</li>
              </ul>
            </div>

            <div className="bg-gray-700 p-6 rounded-lg shadow-md">
              <h3 className="text-lg font-bold mb-2">📁 Funcionalidades</h3>
              <ul className="list-disc list-inside text-sm text-gray-300">
                <li>CRUD de produtos e categorias</li>
                <li>Dashboard com métricas</li>
                <li>Cache de categorias</li>
                <li>Swagger com autenticação via token</li>
              </ul>
            </div>
          </section>

          <footer className="mt-20 text-center text-gray-500 text-sm">
            Desenvolvido por <a href="https://github.com/tiagokochem" className="underline hover:text-white">Tiago Kochem</a> • 2025
          </footer>
        </div>
      </div>
    </>
  );
}
