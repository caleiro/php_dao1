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
                
                $this->setData($results[0]);
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

                $this->setData($results[0]);

            } else {
                throw new Exception("Login e/ou Senha inválidos.");
            }
        }

        public function setData($data)
        {
            $this->setCodigo($data['codigo']);
            $this->setNome($data['nome']);
            $this->setId_postal($data['id_postal']);
            $this->setNif($data['nif']);
            $this->setEmail($data['email']);
            $this->setId_contacto($data['id_contacto']);
            $this->setSenha($data['senha']);
            $this->setObs($data['obs']);
        }

        public function insert(){

            $sql = new Sql();
            $results = $sql->select("CALL sp_segurados_insert(:NOME, :SENHA)", array(
                ':NOME'=>$this->getNome(),
                ':SENHA'=>$this->getSenha()
            ));

            if(count($results)>0){
                $this->setData($results[0]);
            }
        }

        public function __construct($nome = "", $senha ="")
        {
            $this->setNome($nome);
            $this->setSenha($senha);
        }

        public function update($nome, $senha){
            $this->setNome($nome);
            $this->setSenha($senha);

            $sql = new Sql();
            $results = $sql->query("update segurado set nome=:NOME, senha=:SENHA where codigo = :ID", array(
                ':NOME'=>$this->getNome(),
                ':SENHA'=>$this->getSenha(),
                ':ID'=>$this->getCodigo()
            ));
        }

        public function delete(){
            $sql = new Sql();

            $sql->query("delete from segurado where codigo = :ID", array(
                ':ID'=>$this->getCodigo()
            ));

            $this->setCodigo(0);
            $this->setNome("");
            $this->setId_postal(0);
            $this->setNif(0);
            $this->setEmail("");
            $this->setId_contacto(0);
            $this->setSenha("");
            $this->setObs("");
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