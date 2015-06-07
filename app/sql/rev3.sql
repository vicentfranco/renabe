ALTER TABLE f1_formularios ADD COLUMN compania_id integer;
ALTER TABLE f1_formularios ADD COLUMN comite_id integer;
ALTER TABLE f1_formularios
  ADD CONSTRAINT f1f_fk_compania FOREIGN KEY (compania_id)
      REFERENCES companias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE f1_formularios
  ADD CONSTRAINT f1f_fk_comite FOREIGN KEY (comite_id)
      REFERENCES comites (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE f2_formularios ADD COLUMN compania_id integer;
ALTER TABLE f2_formularios ADD COLUMN comite_id integer;
ALTER TABLE f2_formularios
  ADD CONSTRAINT f2f_fk_compania FOREIGN KEY (compania_id)
      REFERENCES companias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE f2_formularios
  ADD CONSTRAINT f2f_fk_comite FOREIGN KEY (comite_id)
      REFERENCES comites (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE f3_formularios ADD COLUMN compania_id integer;
ALTER TABLE f3_formularios ADD COLUMN comite_id integer;
ALTER TABLE f3_formularios
  ADD CONSTRAINT f3f_fk_compania FOREIGN KEY (compania_id)
      REFERENCES companias (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE f3_formularios
  ADD CONSTRAINT f3f_fk_comite FOREIGN KEY (comite_id)
      REFERENCES comites (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION;