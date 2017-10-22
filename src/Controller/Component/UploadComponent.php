<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;

/**
 * Upload component
 */
class UploadComponent extends Component {

    public $width = 1000; // Definida... será a largura máxima da nossa imagem
    public $height = 600; // Definida... será a altura máxima da nossa imagem
    public $max_file = 1;
    public $max_files = 4;

    
    protected function redimensionarCortar($caminho, $nomearquivo, $quality = 60) {
        // Determina as novas dimensões
        $width = $this->width;
        $height = $this->height;

        // Pegamos a largura e altura originais, além do tipo de imagem
        list($width_orig, $height_orig, $tipo, $atributo) = getimagesize($caminho . DS . $nomearquivo);
        
        // Criando a imagem com o novo tamanho
        $novaimagem = imagecreatetruecolor($width, $height);

        switch ($tipo) {
            // Se o tipo da imagem for gif
            case 1:
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            // Se o tipo da imagem for jpg
            case 2:
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 60;
                break;

            // Se o tipo da imagem for png
            case 3:
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 6;
                break;
        } // -> fim switch

        // Envia a nova imagem para o lugar da antiga
        $origem = $image_create($caminho . DS . $nomearquivo);
        //porcentagem que diminuiu ou almentou para manter proporção
        $porcentagem1 = ($height / $height_orig);
        $porcentagem2 = ($width / $width_orig);
        
        //Se a altura original for menor que a largura E a nova largura for maior que a largura requerida
        if ($height_orig < $width_orig && ($width_orig * $porcentagem1 > $width)) {
            //indicando qual o ponto para recortar
            $w_point = (($width - ($width_orig * $porcentagem1)) / 2);
            imagecopyresampled($novaimagem, $origem, $w_point, 0, 0, 0, $width_orig * $porcentagem1, $height, $width_orig, $height_orig);
        } else {
            //indicando qual o ponto para recortar
            $h_point = (($height - ($height_orig * $porcentagem2)) / 2);
            imagecopyresampled($novaimagem, $origem, 0, $h_point, 0, 0, $width, $height_orig * $porcentagem2, $width_orig, $height_orig);
        }
        
        // Copia a imagem original para a imagem com novo tamanho
        $image($novaimagem, $caminho . DS . $nomearquivo, $quality);
        // Destrói a imagem nova criada e já salva no lugar da original
        imagedestroy($novaimagem);
        // Destrói a cópia de nossa imagem original
        imagedestroy($origem);
    }

    protected function redimensionarEsticar($caminho, $nomearquivo) {
        // Determina as novas dimensões
        $width = $this->width;
        $height = $this->height;

        // Pegamos a largura e altura originais, além do tipo de imagem
        list($width_orig, $height_orig, $tipo, $atributo) = getimagesize($caminho . DS . $nomearquivo);


        // Criando a imagem com o novo tamanho
        $novaimagem = imagecreatetruecolor($width, $height);
        switch ($tipo) {

            // Se o tipo da imagem for gif
            case 1:
                // Obtém a imagem gif original
                $origem = imagecreatefromgif($caminho . DS . $nomearquivo);
                // Copia a imagem original para a imagem com novo tamanho
                imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                // Envia a nova imagem gif para o lugar da antiga
                imagegif($novaimagem, $caminho . $nomearquivo);
                break;

            // Se o tipo da imagem for jpg
            case 2:
                // Obtém a imagem jpg original
                $origem = imagecreatefromjpeg($caminho . DS . $nomearquivo);
                // Copia a imagem original para a imagem com novo tamanho
                imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                // Envia a nova imagem jpg para o lugar da antiga
                imagejpeg($novaimagem, $caminho . DS . $nomearquivo);
                break;

            // Se o tipo da imagem for png
            case 3:
                // Obtém a imagem png original
                $origem = imagecreatefrompng($caminho . $nomearquivo);
                // Copia a imagem original para a imagem com novo tamanho
                imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                // Envia a nova imagem png para o lugar da antiga
                imagepng($novaimagem, $caminho . $nomearquivo);
                break;
        } // -> fim switch
        // Destrói a imagem nova criada e já salva no lugar da original
        imagedestroy($novaimagem);
        // Destrói a cópia de nossa imagem original
        imagedestroy($origem);
    }

    public function uploadImg($data, $objeto, $classe) {

        //se os arquivos selecionados passam do máximo permitido
        if (count($data) > $this->max_file) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => $classe, 'action' => 'add']);
        }
        //se não passar do limite
        else {
            foreach ($data as $file) {
                $filename = $file['name'];
                $file_tmp_name = $file['tmp_name'];
                $file_ext = substr(strchr($filename, '.'), 1);
                $dir = WWW_ROOT . 'img';
                $type_allowed = array('png', 'jpg', 'jpeg');
                if (!in_array($file_ext, $type_allowed)) {
                    $this->_registry->getController()->Flash->error('Tipo de arquivo inválido: "' . $file['type'] . '"');
                    return $this->_registry->getController()->redirect(['controller' => $classe, 'action' => 'add']);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    $filename = Text::uuid() . '.' . $file_ext;
                    $filedb = TableRegistry::get($classe);
                    $entity = $filedb->newEntity();
                    $entity->img = $filename;
                    $entity->nome = $objeto['nome'];
                    $entity->descricao = $objeto['descricao'];

                    $filedb->save($entity);

                    if (move_uploaded_file($file_tmp_name, $dir . DS . $filename)) {
                        //Criando thumb
                        $diretorio = $dir . DS . $filename;
                        #pegando as dimensoes reais da imagem, largura e altura
                        list($width, $height) = getimagesize($diretorio);

                        #gerando a a miniatura da imagem
                        $image_p = imagecreatetruecolor(150, 100);
                        $image = imagecreatefromjpeg($diretorio);
                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 150, 100, $width, $height);

                        #o 3º argumento é a qualidade da miniatura de 0 a 100
                        imagejpeg($image_p, $dir . DS . 'thumb' . DS . $filename);
                        imagedestroy($image_p);
                        imagedestroy($image);

                        $caminho = WWW_ROOT . 'img';
//                        $uploadfile = $caminho . DS . $file['name'];
                        // Chamamos a função que redimensiona a imagem
                        $this->redimensionarCortar($caminho, $filename);
                    }
                    //return $this->_registry->getController()->redirect(['action' => 'index']);
                } else {
                    $this->_registry->getController()->Flash->error('Imagem não foi salva');
                    return $this->_registry->getController()->redirect(['action' => 'index']);
                }
            }
            $this->_registry->getController()->Flash->success('Imagens salvas com sucesso!');
            return $this->_registry->getController()->redirect(['action' => 'index']);
        }
    }

    public function uploadImgServico($data, $objeto, $classe) {

        //se os arquivos selecionados passam do máximo permitido
        if (count($data) > $this->max_file) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => $classe, 'action' => 'add']);
        }
        //se não passar do limite
        else {
            foreach ($data as $file) {
                $filename = $file['name'];
                $file_tmp_name = $file['tmp_name'];
                $file_ext = substr(strchr($filename, '.'), 1);
                $dir = WWW_ROOT . 'img';
                $type_allowed = array('png', 'jpg', 'jpeg');
                if (!in_array($file_ext, $type_allowed)) {
                    $this->_registry->getController()->Flash->error('Tipo de arquivo inválido: "' . $file['type'] . '"');
                    return $this->_registry->getController()->redirect(['controller' => 'Imgservicos', 'action' => 'add']);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    $filename = Text::uuid() . '.' . $file_ext;
                    $filedb = TableRegistry::get($classe);
                    $entity = $filedb->newEntity();
                    $entity->img = $filename;
                    $entity->nome = $objeto['nome'];
                    $entity->descricao = $objeto['descricao'];

                    $filedb->save($entity);

                    if (move_uploaded_file($file_tmp_name, $dir . DS . $filename)) {
                        $caminho = WWW_ROOT . 'img';

                        // Chamamos a função que redimensiona a imagem
                        $this->redimensionarCortar($caminho, $filename);
                    }
                    //return $this->_registry->getController()->redirect(['action' => 'index']);
                } else {
                    $this->_registry->getController()->Flash->error('Imagem não foi salva');
                    return $this->_registry->getController()->redirect(['action' => 'index']);
                }
            }
            $this->_registry->getController()->Flash->success('Imagens salvas com sucesso!');
            return $this->_registry->getController()->redirect(['action' => 'index']);
        }
    }

    public function uploadImgloja($data, $objeto) {

        //se os arquivos selecionados passam do máximo permitido
        if (count($data) > $this->max_file) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => 'Imgloja', 'action' => 'add']);
        }
        //se não passar do limite
        else {
            foreach ($data as $file) {
                $filename = $file['name'];
                $file_tmp_name = $file['tmp_name'];
                $file_ext = substr(strchr($filename, '.'), 1);
                $dir = WWW_ROOT . 'img';
                $type_allowed = array('png', 'jpg', 'jpeg');
                if (!in_array($file_ext, $type_allowed)) {
                    $this->_registry->getController()->Flash->error('Tipo de arquivo inválido: "' . $file['type'] . '"');
                    return $this->_registry->getController()->redirect(['controller' => 'Imgloja', 'action' => 'add']);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    $filename = Text::uuid() . '.' . $file_ext;
                    $filedb = TableRegistry::get('Imgloja');
                    $entity = $filedb->newEntity();
                    $entity->img = $filename;
                    $entity->nome = $objeto['nome'];
                    $entity->descricao = $objeto['descricao'];

                    $filedb->save($entity);

                    if (move_uploaded_file($file_tmp_name, $dir . DS . $filename)) {
                        $caminho = WWW_ROOT . 'img';

                        // Chamamos a função que redimensiona a imagem
                        $this->redimensionarCortar($caminho, $filename);
                    }
                    //return $this->_registry->getController()->redirect(['action' => 'index']);
                } else {
                    $this->_registry->getController()->Flash->error('Imagem não foi salva');
                    return $this->_registry->getController()->redirect(['action' => 'index']);
                }
            }
            $this->_registry->getController()->Flash->success('Imagens salvas com sucesso!');
            return $this->_registry->getController()->redirect(['action' => 'index']);
        }
    }

}
