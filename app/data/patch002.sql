-- Patch para alterar:
-- Tabela user: Coluna => password varchar(50) para password varchar(255) 
-- Tabela curriculum: Coluna => id_file int(11) para hash_file varchar(40)

alter table user modify column password varchar(255);

alter table curriculum change id_file hash_file varchar(40);
