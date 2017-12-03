use mydb1;

create table sinais_vitais(
	id int not null auto_increment,
    hora varchar(40),
    data_sinais varchar(40),
    altura varchar(20),
    peso varchar(20),
    imc varchar(20),
    temperatura varchar(20),
    dor varchar(50),
    ativo varchar(20),
    codigo_agendamento int not null,
    primary key (id),
    foreign key (codigo_agendamento) references Agendamento(Cod) ON DELETE CASCADE ON UPDATE CASCADE
);

create table hipoteses(
	id int not null auto_increment,
	hipotese varchar(400),
    observacoes varchar(400),
    ativo varchar(20),
    codigo_agendamento int not null,
    primary key (id),
    foreign key (codigo_agendamento) references Agendamento(Cod) ON DELETE CASCADE ON UPDATE CASCADE
);


create table evolucao(
	id int not null auto_increment,
    evolucao varchar(1000),
    ativo varchar(20),
    codigo_agendamento int not null,
    primary key (id),
    foreign key (codigo_agendamento) references Agendamento(Cod) ON DELETE CASCADE ON UPDATE CASCADE
);

create table prescricao(
	id int not null auto_increment,
    prescricao varchar(1000),
    ativo varchar(20),
    codigo_agendamento int not null,
	primary key (id),
    foreign key (codigo_agendamento) references Agendamento(Cod) ON DELETE CASCADE ON UPDATE CASCADE
);

drop table atestado;
create table atestado(
	id int not null auto_increment,
    texto varchar(1000),
    ativo varchar(20),
    codigo_agendamento int not null,
	primary key (id),
    foreign key (codigo_agendamento) references Agendamento(Cod) ON DELETE CASCADE ON UPDATE CASCADE
);