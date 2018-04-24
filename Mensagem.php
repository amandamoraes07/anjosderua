<?php namespace app\server\models;

    use app\server\controllers\Conn;
    use PDO;

    class Mensagem {

        //recebe um array com os dados da mensagem que insere no banco
        public function save( $mensagem )
        {
            //valida os campos obrigatórios antes
            if( $mensagem->id_adocao <> "" and $mensagem->mensagem <> "" and $mensagem->remetente <> "" )
            {
                $st = Conn::getConn()->prepare("CALL inserir_mensagens(?, ?, ?)");
                $st->bindParam(1, $mensagem->id_adocao);
                $st->bindParam(2, $mensagem->mensagem);
                $st->bindParam(3, $mensagem->remetente);
                return $st->execute();
            }
            else
                return false;
        }

        //retorna todas as mensagens
        public function all() 
        {
            return Conn::getConn()->query("SELECT * FROM Mensagens")->fetchAll(PDO::FETCH_ASSOC);
        }

    }
