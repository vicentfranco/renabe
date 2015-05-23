CREATE TABLE comites(
  id serial NOT NULL,
  codigo character varying,
  nombre character varying,
  distrito_id integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT comites_pk PRIMARY KEY(id),
  CONSTRAINT distrito_fk_comites FOREIGN KEY(distrito_id)
	REFERENCES distritos(id) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT comite_unq_codigo UNIQUE(codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE distritos
   OWNER TO admin_renabe;
