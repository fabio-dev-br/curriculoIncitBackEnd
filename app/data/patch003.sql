-- Patch para alterar:
-- Tabela user: Coluna => identity int(15) para password varchar(15)

alter table user modify column identity varchar(15);