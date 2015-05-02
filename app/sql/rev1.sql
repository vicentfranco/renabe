CREATE TABLE usuarios
(
  id serial NOT NULL,
  nombre character varying NOT NULL,
  cedula character varying,
  username character varying NOT NULL,
  password character varying NOT NULL,
  created timestamp without time zone,
  modified timestamp without time zone,
  usuario_id numeric,
  CONSTRAINT usuario_pk PRIMARY KEY (id),
  CONSTRAINT usuario_unq_cedula UNIQUE (cedula),
  CONSTRAINT usuario_unq_username UNIQUE (username)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuarios
  OWNER TO admin_renabe;
  

CREATE TABLE roles
(
  id serial NOT NULL,
  nombre character varying,
  perms character varying,
  created timestamp without time zone,
  modified timestamp without time zone,
  usuario_id integer,
  CONSTRAINT rol_pk PRIMARY KEY (id),
  CONSTRAINT rol_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE roles
  OWNER TO admin_renabe;
  
CREATE TABLE carpetas
(
  id serial NOT NULL,
  nombre character varying,
  codigo character varying,
  usuario_id integer,
  CONSTRAINT carpeta_id PRIMARY KEY (id),
  CONSTRAINT carpeta_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT carpeta_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE carpetas
  OWNER TO admin_renabe;
  
  
CREATE TABLE actividades
(
  id serial NOT NULL,
  nombre character varying,
  descripcion character varying,
  created timestamp without time zone,
  modified timestamp with time zone,
  usuario_id integer,
  CONSTRAINT actividad_pk PRIMARY KEY (id),
  CONSTRAINT actividad_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE actividades
  OWNER TO admin_renabe;
  

CREATE TABLE departamentos
(
  id serial NOT NULL,
  codigo character varying,
  nombre character varying,
  descripcion character varying,
  created timestamp without time zone,
  modified timestamp without time zone,
  usuario_id integer,
  CONSTRAINT departamento_pk PRIMARY KEY (id),
  CONSTRAINT departamento_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT departamento_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE departamentos
  OWNER TO admin_renabe;
  
CREATE TABLE distritos
(
  id serial NOT NULL,
  codigo character varying,
  nombre character varying,
  descripcion character varying,
  departamento_id integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT distritos_pk PRIMARY KEY (id),
  CONSTRAINT distrito_pk_departamento FOREIGN KEY (departamento_id)
      REFERENCES departamentos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT distrito_pk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT distrito_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE distritos
  OWNER TO admin_renabe;

CREATE TABLE compania
(
  id serial NOT NULL,
  nombre character varying,
  codigo character varying,
  descripcion character varying,
  distrito_id integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT compania_pk PRIMARY KEY (id),
  CONSTRAINT compania_fk_distrito FOREIGN KEY (usuario_id)
      REFERENCES distritos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT compania_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT compania_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE compania
  OWNER TO admin_renabe;
  

CREATE TABLE asentamientos
(
  id serial NOT NULL,
  nombre character varying,
  codigo character varying,
  compania_id integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT asentamiento_pk PRIMARY KEY (id),
  CONSTRAINT asentamiento_fk_compania FOREIGN KEY (compania_id)
      REFERENCES compania (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT asentamiento_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT asentamiento_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE asentamientos
  OWNER TO admin_renabe;
  
CREATE TABLE productores
(
  id serial NOT NULL,
  nombre character varying,
  cedula character varying,
  total_familiares integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT productor_pk PRIMARY KEY (id),
  CONSTRAINT productor_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT productor_unq_cedula UNIQUE (cedula)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE productores
  OWNER TO admin_renabe;
  

CREATE TABLE zonas
(
  id serial NOT NULL,
  nombre character varying,
  descripcion character varying,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT zonas_pk PRIMARY KEY (id),
  CONSTRAINT zona_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE zonas
  OWNER TO admin_renabe;
  
CREATE TABLE f3_formularios
(
  id serial NOT NULL,
  codigo character varying,
  fecha_inicio timestamp without time zone,
  fecha_fin timestamp without time zone,
  fecha date,
  carpeta_id integer,
  usuario_id integer,
  asentamiento_id integer,
  modified timestamp without time zone,
  created timestamp without time zone,
  CONSTRAINT f3f_pk PRIMARY KEY (id),
  CONSTRAINT f3f_fk_asentamiento FOREIGN KEY (asentamiento_id)
      REFERENCES asentamientos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f3f_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f3_formularios
  OWNER TO admin_renabe;
  
CREATE TABLE f3_detalles
(
  id serial NOT NULL,
  formulario_id integer,
  productor_id integer,
  superficie_finca numeric,
  actividad_id integer,
  codigo_exclusion character varying,
  CONSTRAINT f3_detalle_pk PRIMARY KEY (id),
  CONSTRAINT f3_detalle_productor FOREIGN KEY (productor_id)
      REFERENCES productores (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f3_fk_actividad FOREIGN KEY (actividad_id)
      REFERENCES actividades (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f3_fk_formulario FOREIGN KEY (formulario_id)
      REFERENCES f3_formularios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f3_detalles
  OWNER TO admin_renabe;
  
CREATE TABLE f2_formularios
(
  id serial NOT NULL,
  codigo character varying,
  fecha_inicio timestamp without time zone,
  fecha_fin timestamp without time zone,
  usuario_id integer,
  encuestador_id integer,
  autoridad_id integer,
  fecha timestamp without time zone,
  codigo_exclusion character varying,
  created timestamp without time zone,
  modified timestamp without time zone,
  asentamiento_id integer,
  carpeta_id integer,
  CONSTRAINT f2f_pk PRIMARY KEY (id),
  CONSTRAINT f2f_fk_asentamiento FOREIGN KEY (asentamiento_id)
      REFERENCES asentamientos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2f_fk_autoridad FOREIGN KEY (autoridad_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2f_fk_carpeta FOREIGN KEY (carpeta_id)
      REFERENCES carpetas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2f_fk_encuestador FOREIGN KEY (encuestador_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2f_fk_usuario FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2f_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f2_formularios
  OWNER TO admin_renabe;
  
CREATE INDEX fki_f2f_fk_carpeta
  ON f2_formularios
  USING btree
  (carpeta_id);
  
CREATE INDEX fki_f2f_fk_asentamiento
  ON f2_formularios
  USING btree
  (asentamiento_id);
  

CREATE TABLE f2_detalles
(
  id serial NOT NULL,
  productor_id integer,
  actividad_id integer,
  zona_id integer,
  codigo_exclusion character varying,
  formulario_id integer,
  CONSTRAINT f2_detalle_pk PRIMARY KEY (id),
  CONSTRAINT f2_detalle_fk_actividad FOREIGN KEY (actividad_id)
      REFERENCES actividades (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2_detalle_fk_formulario FOREIGN KEY (formulario_id)
      REFERENCES f2_formularios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f2_detalle_fk_zona FOREIGN KEY (zona_id)
      REFERENCES zonas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f2_detalles
  OWNER TO admin_renabe;
  
CREATE TABLE f1_formularios
(
  id serial NOT NULL,
  codigo character varying,
  fecha_inicio timestamp without time zone,
  fecha_fin timestamp without time zone,
  usuario_id integer,
  encuestador_id integer,
  fecha timestamp without time zone,
  created timestamp without time zone,
  modified timestamp without time zone,
  asentamiento_id integer,
  carpeta_id integer,
  CONSTRAINT f1f_pk PRIMARY KEY (id),
  CONSTRAINT f1f_fk_asentamiento FOREIGN KEY (asentamiento_id)
      REFERENCES asentamientos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_carpeta FOREIGN KEY (carpeta_id)
      REFERENCES carpetas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_encuestador FOREIGN KEY (encuestador_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_usuarios FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f1_formularios
  OWNER TO admin_renabe;

  
CREATE TABLE f1_formularios
(
  id serial NOT NULL,
  codigo character varying,
  fecha_inicio timestamp without time zone,
  fecha_fin timestamp without time zone,
  usuario_id integer,
  encuestador_id integer,
  fecha timestamp without time zone,
  created timestamp without time zone,
  modified timestamp without time zone,
  asentamiento_id integer,
  carpeta_id integer,
  CONSTRAINT f1f_pk PRIMARY KEY (id),
  CONSTRAINT f1f_fk_asentamiento FOREIGN KEY (asentamiento_id)
      REFERENCES asentamientos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_carpeta FOREIGN KEY (carpeta_id)
      REFERENCES carpetas (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_encuestador FOREIGN KEY (encuestador_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_fk_usuarios FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT f1f_unq_codigo UNIQUE (codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f1_formularios
  OWNER TO admin_renabe;

CREATE TABLE f1_detalles
(
  id serial NOT NULL,
  formulario_id integer,
  productor_id integer,
  superficie_finca numeric,
  superficie_cultivo numeric,
  total_contratados integer,
  bovinos integer,
  porcinos integer,
  aves integer,
  codigo_exclusion character varying,
  CONSTRAINT f1_detalle_pk PRIMARY KEY (id),
  CONSTRAINT f1_detalle_fk_formulario FOREIGN KEY (formulario_id)
      REFERENCES f1_formularios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE f1_detalles
  OWNER TO admin_renabe;
  

CREATE INDEX fki_f1f_fk_carpeta
  ON f1_formularios
  USING btree
  (carpeta_id);



