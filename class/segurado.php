<?php
    class Segurado
    {
        private $codigo;
        private $nome;
        private $id_postal;
        private $nif;
        private $email;
        private $id_contacto;
        private $senha;
        private $obs;
        //codigo
        public function getCodigo(){
            return $this->codigo;
        }
        public function setCodigo($value){
            $this->codigo = $value;
        }
        //nome
        public function getNome(){
            return $this->nome;
        }
        public function setNome($value){
            $this->nome = $value;
        }
        //id_postal
        public function getId_postal(){
            return $this->id_postal;
        }

        public function setId_postal($value){
            $this->id_postal = $value;
        }
        //nif
        public function getNif(){
            return $this->nif;
        }
        public function setNif($value){
            $this->nif = $value;
        }
        //email
        public function getEmail(){
            return $this->email;
        }

        public function setEmail($value){
            $this->email = $value;
        }
        //id_contacto
        public function getId_contacto(){
            return $this->id_contacto;
        }
        public function setId_contacto($value){
            $this->id_contacto = $value;
        }
        //senha
        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($value){
            $this->senha = $value;
        }
        //obs
        public function getObs(){
            return $this->obs;
        }
        public function setObs($value){
            $this->obs = $value;
        }
        # Ler dados de um segurado
        public function loadById($id)
        {
            $sql = new Sql();
            $results = $sql->select("select * from segurado where codigo = :ID", array(
                ":ID"=>$id
            ));

            if(count($results) > 0){
                $row=$results[0];

                $this->setCodigo($row['codigo']);
                $this->setNome($row['nome']);
                $this->setId_postal($row['id_postal']);
                $this->setNif($row['nif']);
                $this->setEmail($row['email']);
                $this->setId_contacto($row['id_contacto']);
                $this->setSenha($row['senha']);
                $this->setObs($row['obs']);
            }
        }

        # Listagem todos segurados
        //static - assim não é preciso instanciar o objeto
        public static function getList() 
        {
            $sql = new Sql();
            return $sql->select("select * from segurado order by nome");
        }

        # Procura segurado que tenhma um dado nome...
        //static - assim não é preciso instanciar o objeto
        public static function search($login) 
        {
            $sql = new Sql();
            return $sql->select("select * from segurado where nome like :search",array(
                ':search'=>"%".$login."%"
            ));
        }

        # Login
        public function login($id, $pass)
        {
            $sql = new Sql();
            $results = $sql->select("select * from segurado where codigo = :ID and senha = :SENHA", array(
                ":ID"=>$id,
                ":SENHA"=>$pass
            ));

            if(count($results) > 0){
                $row=$results[0];

                $this->setCodigo($row['codigo']);
                $this->setNome($row['nome']);
                $this->setId_postal($row['id_postal']);
                $this->setNif($row['nif']);
                $this->setEmail($row['email']);
                $this->setId_contacto($row['id_contacto']);
                $this->setSenha($row['senha']);
                $this->setObs($row['obs']);
            } else {
                throw new Exception("Login e/ou Senha inválidos.");
            }
        }

        public function __toString(){
            
            return json_encode(array(
                "codigo"=>$this->getCodigo(),
                "nome"=>$this->getNome(),
                "id_postal"=>$this->getId_postal(),
                "nif"=>$this->getNif(),
                "email"=>$this->getEmail(),
                "id_contacto"=>$this->getId_contacto(),
                "senha"=>$this->getSenha(),
                "obs"=>$this->getObs()
            ));
        }
        
    }
?>