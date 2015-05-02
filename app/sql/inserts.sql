insert into usuarios(nombre, cedula, username, password, created, modified) values 
('Vicente Franco','3942308','vfranco', '123456',now(), now());
commit;

insert into departamentos(codigo, nombre, created, modified, usuario_id) 
values ('11','Central', now(), now(), 1);
commit;