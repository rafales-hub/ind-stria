create table setores (
 id INT auto_increment primary key,
 nome VARCHAR (100) not null
);

create table equipamentos (
 id INT auto_increment primary key,
 nome VARCHAR (100) not null,
 patrimonio VARCHAR (100) not null unique,
 setor_id INT,
 status VARCHAR (100) default 'ativo',
 foreign key (setor_id) references setores(id)

);

CREATE TABLE funcionarios (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(150) NOT NULL,
 matricula VARCHAR(20) NOT NULL UNIQUE,
 cargo VARCHAR(100) NOT null
 );

ALTER TABLE funcionarios
ADD COLUMN setor_id INT NOT NULL,
ADD CONSTRAINT fk_funcionarios_setor
FOREIGN KEY (setor_id) REFERENCES setores(id);

insert into funcionarios (nome,matricula,cargo) values ('Rodrigo','0001','03');
insert into setores (nome) values ('Informática');
insert into setores (nome) values ('Segurança');

insert into equipamentos (nome,patrimonio,setor_id,status) values ('rafael','cultural','2','ativo');




CREATE TABLE chamados_manutencao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'aberto',
    equipamento_id INT,
    user_id INT,

    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);


insert into chamados_manutencao (titulo,status,equipamento_id,user_id)
values ('Manutanção', 'ativo', '3', '2');








create table manutencoes (
	id BIGINT primary key auto_increment,
	equipamento_id BIGINT,
	funcionario_id BIGINT,
	tipo VARCHAR(50),
	descricao TEXT not null,
	data_manutencao DATE not null,
	proxima_manutencao DATE,
	custo DECIMAL(10,2) not null,
	status VARCHAR(20) default "Pendente",
	
	FOREIGN key (equipamento_id) references equipamentos (id),
	FOREIGN key (funcionario_id) references funcionarios (id)

);



create table ordens_producao (
	id BIGINT primary key auto_increment,
	setor_id BIGINT,
	funcionario_id BIGINT,
	codigo_ordem VARCHAR(30),
	produto VARCHAR (100) not null,
	quantidade_planejada INTEGER not null,
	quantidade_produzida INTEGER not null,
	data_inicio DATETIME not null,
	data_fim DATETIME not null,
	status VARCHAR(20) default "Aberta",
	descricao TEXT not null,
	
	
	FOREIGN key (setor_id) references setores  (id),
	FOREIGN key (funcionario_id) references funcionarios (id)

);

select * from setores s
where s.nome like '%T%';













