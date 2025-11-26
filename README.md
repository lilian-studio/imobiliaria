# Imobiliária - Exemplo PHP + MySQL

Projeto de exemplo para cadastro de imóveis com upload de imagens e visualização.

Pré-requisitos
- PHP 8+ com PDO e extensão fileinfo
- MySQL/MariaDB

Instalação

1. Crie o banco de dados e tabelas executando o arquivo `database/schema.sql`:

```sql
-- no terminal mysql:
mysql -u root -p < database/schema.sql
```

2. Ajuste as credenciais em `config.php` (variáveis `$DB_HOST`, `$DB_NAME`, `$DB_USER`, `$DB_PASS`).

3. Garanta permissão de escrita para a pasta `uploads`:

```bash
chmod 755 uploads
chown www-data:www-data uploads   # opcional, dependendo do ambiente
```

4. Rode o servidor PHP embutido para desenvolvimento:

```bash
php -S localhost:8000
```

Arquivos principais
- `index.php` — lista de imóveis
- `create.php` — formulário de cadastro
- `upload.php` — processa o cadastro e upload de imagens
- `view.php` — detalhes do imóvel + galeria
- `src/db.php` — conexão PDO
- `config.php` — configurações do projeto

Observações
- Limites básicos de upload e validação MIME estão implementados em `upload.php`.
- Em produção, use validações adicionais, proteções CSRF e controle de acesso.
# imobiliaria