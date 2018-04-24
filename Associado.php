<?php namespace app\server\models;

    use app\server\controllers\Conn;
    use PDO;

    class Associados {

        //recebe um array com os dados do associado que insere no banco
        public function save( $associados )
        {
            //valida os campos obrigatórios antes
            if( $associados->nome <> "" and $associados->sexo <> "" )
            {
                $st = Conn::getConn()->prepare("CALL inserir_associados(?, ?, ?)");
                $st->bindParam(1, $associados->nome);
                $st->bindParam(2, $animal->sexo);
                $st->bindParam(3, $animal->email);
                return $st->execute();
            }
            else
                return false;
        }

        //retorna todos os associados
        public function all() 
        {
            return Conn::getConn()->query("SELECT * FROM Associados")->fetchAll(PDO::FETCH_ASSOC);
        }

        //retorna associado pelo id
        public function find($id) 
        {
            $st = Conn::getConn()->prepare(" SELECT * FROM Associados WHERE id=? ");
            $st->bindParam(1, $id);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        }

        //atualiza dados do associado 
        public function update( $associados )
        {
            //valida os campos obrigatórios antes
            if( $associados->id <> "" and $associados->nome <> "" and $associados->sexo <> "" and $associados->email <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE Associados SET nome=?, sexo=?, email=? WHERE id=? ");

                $st->bindParam(1, $associados->nome);
                $st->bindParam(2, $associados->sexo);
                $st->bindParam(3, $associados->email);
                $st->bindParam(4, $associados->id);
                return $st->execute();
            }
            else
                return false;
        }

        //deleta associado pelo id
        public function trash( $id )
        {
            $st = Conn::getConn()->prepare(" DELETE FROM Associados WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }
