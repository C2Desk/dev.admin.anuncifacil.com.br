<?php

namespace App\Entities\posts;

use DateTime;

class PostEntitie {

        private int $ip = 0;
        private string $titulo = "";
        private string $sub_titulo = "";
        private string $descr = "";
        private string $foto = "";
        private string $foto2 = "";
        private string $legenda = "";
        private string $texto = "";
        private string $video = "";
        private string $por = "";
        private string $tipo = "";
        private string $link = "";
        private string $destaque = "";
        private string $status = "";
        private string $data = "";

        public function __construct()
        {
        }
        
        public function getIp()
        {
            return $this->ip;
        }
        public function getTitulo()
        {
            return $this->titulo;
        }
        public function getSub_titulo()
        {
            return $this->sub_titulo;
        }
        public function getDescr()
        {
            return $this->descr;
        }
        public function getfFoto()
        {
            return $this->foto;
        }
        public function getFoto2()
        {
            return $this->foto2;
        }
        public function getLegenda()
        {
            return $this->legenda;
        }
        public function getTexto()
        {
            return $this->texto;
        }
        public function getvideo()
        {
            return $this->video;
        }
        public function getPor()
        {
            return $this->por;
        }
        public function getTipo()
        {
            return $this->tipo;
        }
        public function getLink()
        {
            return $this->link;
        }
        public function getDestaque()
        {
            return $this->destaque;
        }
        public function getStatus()
        {
            return $this->status;
        }

        public function getData()
        {
            return $this->data;
        }

        public function setIp ($ip) 
        {
            $this->ip = $ip;
        } 
        public function setTitulo ($titulo) 
        {
            $this->titulo = $titulo;
        } 
        public function setSubTitulo ($sub_titulo) 
        {
            $this->sub_titulo = $sub_titulo;
        } 
        public function setDescr ($descr) 
        {
            $this->descr = $descr;
        } 
        public function setFoto ($foto) 
        {
            $this->foto = $foto;
        } 
        public function setFoto2 ($foto2) 
        {
            $this->foto2 = $foto2;
        } 
        public function setLegenda ($legenda) 
        {
            $this->legenda = $legenda;
        } 
        public function setTexto ($texto) 
        {
            $this->texto = $texto;
        } 
        public function setVideo ($video) 
        {
            $this->video = $video;
        } 
        public function setPor ($por) 
        {
            $this->por = $por;
        } 
        public function setTipo ($tipo) 
        {
            $this->tipo = $tipo;
        } 
        public function setLink ($link) 
        {
            $this->link = $link;
        } 
        public function setDestaque ($destaque) 
        {
            $this->destaque = $destaque;
        } 
        public function setStatus ($status) 
        {
            $this->status = $status;
        }
        
        public function setData($data)
        {
            $this->data = $data;
        }

}