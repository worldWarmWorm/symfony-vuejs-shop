<?php

namespace App\Form\Handler;

use App\Entity\Product;
use App\Utils\File\FileSaver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class ProductFormHandler
{
    private EntityManagerInterface $entityManager;
    private FileSaver $fileSaver;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FileSaver $fileSaver
     */
    public function __construct(EntityManagerInterface $entityManager, FileSaver $fileSaver)
    {

        $this->entityManager = $entityManager;
        $this->fileSaver = $fileSaver;
    }

    public function processEditForm(Product $product, Form $form)
    {
        $this->entityManager->persist($product);

        $newImageFile = $form->get('newImage')->getData();

        $tempImageFileName = $newImageFile
            ? $this->fileSaver->saveUploadedFileIntoTemp($newImageFile)
            : null;

        dd($tempImageFileName);
        // TODO: ADD A NEW IMAGE WITH DEFFERENT SIZES TO THE PRODUCT
        // 1. Save product's changes (+)
        // 2. Save uploaded file into temp folder

        // 3. Work with Product (addProductImage) and ProductImage
        // 3.1 Get path to folder with images of product

        // 3.2 Work with ProductImage
        // 3.2.1 Resize and save image into folder (BIG, MIDDLE, SMALL)
        // 3.2.2 Create ProductImage and return it to Product

        // 3.3 Save Product with new ProductImage
        $this->entityManager->flush();

        return $product;
    }
}