insert into usuarios(nombre, cedula, username, password, created, modified) values 
('Vicente Franco','3942308','vfranco', '123456',now(), now());
commit;

insert into departamentos(codigo, nombre, created, modified, usuario_id) 
values ('11','Central', now(), now(), 1);
commit;

insert into distritos (codigo, nombre, departamento_id, usuario_id, created, modified)
values ('1','Luque',1, 1, now(), now());
insert into distritos (codigo, nombre, departamento_id, usuario_id, created, modified)
values ('2','Asuncion',1, 1, now(), now());

insert into compania(codigo, nombre, distrito_id, usuario_id, created, modified)
values ('1', '1ra compañia', 2, 1, now(), now());

insert into asentamientos(codigo, nombre, compania_id, usuario_id, created, modified)
values ('1','San miguel', 2, 1, now(), now());