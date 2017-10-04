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

    public $max_file = 1;
    public $max_files = 4;

    public function uploadBanner($data, $objeto) {

        //se os arquivos selecionados passam do máximo permitido
        if (count($data) > $this->max_file) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => 'banner', 'action' => 'add']);
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
                    return $this->_registry->getController()->redirect(['controller' => 'Banner', 'action' => 'add']);
                } elseif (is_uploaded_file($file_tmp_name)) {
                    $filename = Text::uuid() . '.' . $file_ext;
                    $filedb = TableRegistry::get('Banner');
                    $entity = $filedb->newEntity();
                    $entity->img = $filename;
                    $entity->nome = $objeto['nome'];
                    $entity->descricao = $objeto['descricao'];

                    $filedb->save($entity);

                    if (move_uploaded_file($file_tmp_name, $dir . DS . $filename)) {
                        //Criando thumb
                        $diretorio = $dir.DS.$filename;
                        #pegando as dimensoes reais da imagem, largura e altura
                        list($width, $height) = getimagesize($diretorio);

                        #gerando a a miniatura da imagem
                        $image_p = imagecreatetruecolor(100,100);
                        $image = imagecreatefromjpeg($diretorio);
                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 100, 100, $width, $height);

                        #o 3º argumento é a qualidade da miniatura de 0 a 100
                        imagejpeg($image_p,$dir .DS.'thumb'.DS. $filename);
                        imagedestroy($image_p);
                        imagedestroy($image);
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

    public function uploadImgServico($data, $objeto) {

        //se os arquivos selecionados passam do máximo permitido
        if (count($data) > $this->max_file) {
            $this->_registry->getController()->Flash->error('Limite de arquivos excedidos.');
            return $this->_registry->getController()->redirect(['controller' => 'Imgservicos', 'action' => 'add']);
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
                    $filedb = TableRegistry::get('Imgservicos');
                    $entity = $filedb->newEntity();
                    $entity->img = $filename;
                    $entity->nome = $objeto['nome'];
                    $entity->descricao = $objeto['descricao'];

                    $filedb->save($entity);

                    move_uploaded_file($file_tmp_name, $dir . DS . $filename);
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

                    move_uploaded_file($file_tmp_name, $dir . DS . $filename);
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
