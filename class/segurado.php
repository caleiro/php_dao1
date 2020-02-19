<?php
    class Segurado
    {
        private $codigo;
        private $nome;
        private $id_postal;
        private $nif;
        private $email;
        private $id_contacto;
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
                $this->setObs($row['obs']);
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
                "obs"=>$this->getObs()
            ));
        }
        
    }
?>