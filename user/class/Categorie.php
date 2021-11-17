<?php
    namespace App;

    Class Categorie
    {
        private $id;
        private $designation;

        public function getId () {
            return $this->id;
        }

        public function getDesignation () {
            return $this->designation;
        }

        public function setDesignation () {
            return $this->designation = $designation;
        }

        public function setId () {
            return $this->id = $id;
        }

        public static function insertCategorie ($db, $designation)
        {
            $g = ['designation'=>$designation];
            $sql = 'INSERT INTO `categorie`(`designation`) VALUES(:designation)';
            $req = $db->prepare($sql);
            $req->execute($g);
        }

        public static function getCategorie ($db)
        {
            $data = $db->query('SELECT * FROM onesha_db.categorie');
            $categ = $data->fetchAll(\PDO::FETCH_CLASS, \App\Categorie::class);
            $data->closeCursor();
            return $categ;
        }

        public static function updateCategorie ($db, $id, $designation)
        {
            $g = ['id'=>$id, 'designation'=>$designation];
            $sql = 'UPDATE `categorie` SET `designation`=:designation WHERE `id`=:id';
            $req = $db->prepare($sql);
            $req->execute($g);
        }
    }