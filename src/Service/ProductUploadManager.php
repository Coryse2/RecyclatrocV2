<?php
namespace App\Service;

use Symfony\Component\Form\Form;


class ProductUploadManager
{
    private $targetFolderPath;

    public function __construct($targetFolderPath)
    {
        $this->targetFolderPath = $targetFolderPath;
    }

    public function upload(Form $formFile)
    {
        $file = $formFile->getData();
        if ($file != null) {
            // on stock le nom du fichier
            // il est constitué de l'id du film, d'un point et de l'extension du fichier
            // ex : 140.jpeg
            $filenameToStore = md5(uniqid(mt_rand(1, 1000))) . '.' . $file->getClientOriginalExtension();
            // on déplace le fichier et on stocke ses informations dans une variable
            $movedFile = $file->move($this->targetFolderPath, $filenameToStore);

            // maintenant, la méthode retourne le chemin du fichier uploadé
            return $movedFile->getPathname();

        //return $this->targetFolderPath;
        } else {
            return null;
        }
    }
}