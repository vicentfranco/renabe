ALTER TABLE asentamientos DROP COLUMN compania_id;

ALTER TABLE asentamientos DROP CONSTRAINT asentamiento_fk_compania;

ALTER TABLE asentamientos ADD COLUMN distrito_id integer;

ALTER TABLE asentamientos
  ADD CONSTRAINT asentamiento_fk_distrito FOREIGN KEY (distrito_id)
      REFERENCES distritos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;

