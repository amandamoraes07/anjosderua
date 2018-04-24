<?php namespace app\server\models;

    use app\server\controllers\Conn;
    use PDO;

    class Adocao {

        //recebe um array com os dados da adocao que insere no banco
        public function save( $adocao )
        {
            //valida os campos obrigatórios antes
            if( $adocao->id_animal <> "" and $adocao->id_associado <> "" )
            {
                $st = Conn::getConn()->prepare("CALL inserir_adocoes(?, ?)");
                $st->bindParam(1, $adocao->id_animal);
                $st->bindParam(2, $adocao->id_associado);
                return $st->execute();
            }
            else
                return false;
        }

        //retorna todas as adocoes
        public function all() 
        {
            return Conn::getConn()->query("SELECT * FROM Adocoes")->fetchAll(PDO::FETCH_ASSOC);
        }

        //retorna adocao pelo id
        public function find($id) 
        {
            $st = Conn::getConn()->prepare(" SELECT * FROM Adocoes WHERE id=? ");
            $st->bindParam(1, $id);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        }

        //retorna adocao pelo id_associado
        public function find($id) 
        {
            $st = Conn::getConn()->prepare(" SELECT * FROM Adocoes WHERE id_associado=? ");
            $st->bindParam(1, $id);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        }

        //atualiza dados da adocao 
        public function update( $adocao )
        {
            //valida os campos obrigatórios antes
            if( $adocao->id <> "" and $adocao->id_animal <> "" and $adocao->id_associado <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE Adocoes SET id_animal=?, id_associado=? WHERE id=? ");

                $st->bindParam(1, $adocao->id_animal);
                $st->bindParam(2, $adocao->id_associado);
                $st->bindParam(3, $adocao->id);
                return $st->execute();
            }
            else
                return false;
        }

        //deleta adocao pelo id
        public function trash( $id )
        {
            $st = Conn::getConn()->prepare(" DELETE FROM Adocoes WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }
