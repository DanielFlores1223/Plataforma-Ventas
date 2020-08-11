<?php

class Nodo{
    public $dato;
    public $siguiente;

    public function __construct($dato){
        $this->dato=$dato;
        $this->siguiente=null;
    }

    public function setDato($dato){
        $this->dato=$dato;
    }

    public function getDato(){
        return $this->dato;
    }

    public function setSiguiente($siguiente){
        $this->siguiente=$siguiente;
    }

    public function getSiguiente(){
        return $this->siguiente;
    }
}

class Cola{

    public function crearNodo($dato){
        $nodo = new Nodo($dato);
        return $nodo;
    }

    public function listaVacia($Cola){
        if($Cola==null)
            return true;
        
        return false;
    }

    public function agregarInicio($Cola,$dato){
        
        if($this->listaVacia($Cola)){
            $Cola=$this->crearNodo($dato);
        }
        else{
            $auxiliar = $Cola;
            $Cola= $this->crearNodo($dato);
            $Cola->siguiente=$auxiliar;
        }
        return $Cola;
    }

    public function agregarFinal($Cola, $dato){
        if( $this->listaVacia($Cola) ){
            $Cola = $this->crearNodo($dato);
        }else{        
            $auxiliar = $Cola;
            while($auxiliar->siguiente != null){
                $auxiliar = $auxiliar->siguiente;
            }
            $auxiliar->siguiente = $this->crearNodo($dato);
        } 
        return $Cola;
     }

     public function encolar($Cola,$dato){
        
        if($this->listaVacia($Cola)){
            $Cola= $this->crearNodo($dato);
        }
        else{
            $auxiliar = $Cola;
            while($auxiliar->siguiente!=NUll){

                $auxiliar=$auxiliar->siguiente;
            }
            $auxiliar->siguiente=$this->crearNodo($dato);
        }
        return $Cola;
    }
    
    /*public Nodo encolar(Nodo lista, int dato){
        if( listaVacia(lista) ){
            lista = crearNodo(dato);
        }else{        
            Nodo auxiliar = lista;
            while(auxiliar.siguiente != null){
                auxiliar = auxiliar.siguiente;
            }
            auxiliar.siguiente = crearNodo(dato);
        } 
        return lista;
    } */
     
    
    public function desencolar($Cola){
        $auxiliar=$Cola;
        $anterior=$Cola;
        $pop=false;
        if(!$this->listaVacia($Cola)){
            
            if($auxiliar->siguiente==null){
                $Cola=null;
            }else{
                while($pop==false){
                    if($auxiliar->siguiente==null){
                        $auxiliar=$anterior;
                        $auxiliar->siguiente=null;
                        $pop=true;
                    }
                    else{
                        $anterior=$auxiliar;
                        $auxiliar=$auxiliar->siguiente;
                    }
                }
            }
        }else{
            //System.out.println("\nPila Vacia");
        }
        return $Cola;
    }
}