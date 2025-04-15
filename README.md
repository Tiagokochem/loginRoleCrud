# 📦 Sistema de Controle de Estoque — Rede Parcerias

Este projeto que consiste consiste em um sistema completo de controle de estoque, desenvolvido com **Laravel** (backend) e **React + Inertia.js** (frontend), utilizando autenticação via **JWT**, controle de permissões por perfil, e testes automatizados.

---

## 🚀 Tecnologias Utilizadas

- Laravel 10 (API REST)
- React.js + Vite + Inertia.js
- TailwindCSS
- Laravel Breeze (auth + frontend)
- JWT Authentication (`tymon/jwt-auth`)
- MySQL
- Swagger (L5 Swagger)
- PHPUnit (com testes de API e autenticação)
- Docker + Laravel Sail

---

## 🔐 Níveis de Acesso

- **Administrador**: pode criar, editar e excluir produtos e categorias.
- **Operador**: pode visualizar e atualizar produtos.
- **Usuário Comum**: pode apenas visualizar.

---

## ✅ Funcionalidades

- Autenticação com JWT
- CRUD de produtos com:
  - Nome, descrição, quantidade, preço, SKU, categoria
- Filtros por categoria, nome e faixa de preço
- Cadastro e edição de categorias
- API protegida versionada (`/api/v1/...`)
- Cache de categorias
- Swagger com documentação da API
- Dashboard com métricas totais
- Testes automatizados (login, produto, categoria)

---

## 📂 Organização do Projeto

- `/app/Http/Controllers/Api` — Controllers da API
- `/resources/js/Pages` — Páginas React com Inertia
- `/tests/Feature` — Testes de API e autenticação
- `/database/seeders` — Seeders de exemplo (em construção)

---

## 🧪 Executar Testes

```bash
./vendor/bin/sail artisan migrate:fresh --env=testing
./vendor/bin/sail artisan test
```

---

## 🧾 Documentação da API

Após instalar o projeto:

```bash
./vendor/bin/sail artisan l5-swagger:generate
```

Acesse: [http://localhost/api/documentation](http://localhost/api/documentation)

---

## 🐳 Rodar com Docker

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
```

---

## 🧙 Usuários de Teste

| Nome       | Email               | Senha     | Role       |
|------------|---------------------|-----------|------------|
| Admin      | admin@admin.com     | password  | admin      |
| Operador   | operador@admin.com  | password  | operador   |
| Usuário    | user@admin.com      | password  | user       |

(Obs: criar via Seeder ou manualmente no banco)

---

## Como executar localmente

# Clone o repositório
git clone https://github.com/Tiagokochem/loginRoleCrud.git
cd loginRoleCrud

# Instala as dependências via Composer com Sail
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs

# Inicializa os containers
./vendor/bin/sail up -d

# Executa as migrations (e seeders se desejar)
./vendor/bin/sail artisan migrate --seed

![admin](https://github.com/user-attachments/assets/ac22f249-210e-492b-92fb-53202bd19df7)
![cadastro](https://github.com/user-attachments/assets/b3df99fe-42c5-4a0b-b829-494fc462536a)
![categoria](https://github.com/user-attachments/assets/2e2f6d25-bfd6-43f2-adbc-843c09885674)



## 🧠 Autor

Desenvolvido por **Tiago Kochem** [@tiagokochem](https://github.com/tiagokochem)
