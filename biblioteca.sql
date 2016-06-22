create database biblioteca;
	use biblioteca;

	create table usuario(
		nombre varchar(50) not null,
		apellido varchar(50) not null,
		usuario varchar(20) not null,
		password varchar(20) not null,
		primary key(usuario),
		unique(usuario)
	);

	create table libro(
		nombre varchar(50) not null,
		anio int not null,
		codigo varchar(50) not null,
		autor varchar(50) not null,
		stock int not null,
		primary key (codigo),
		unique(codigo)
	);