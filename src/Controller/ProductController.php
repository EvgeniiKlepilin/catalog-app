<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="show_index")
     */
    public function showIndexAction()
    {
        $categories[] = $this->getDoctrine()->getRepository(Category::class)->findOneByName('electronics');
        $categories[] = $this->getDoctrine()->getRepository(Category::class)->findOneByName('appliances');
        return $this->render('index/index.html.twig', [
                'categories' => $categories
            ]);
    }
    
    /**
     * @Route("/{categoryName}/{subcategoryName}/{productCode}", name="show_product")
     */
    public function showProductAction(string $categoryName, string $subcategoryName, string $productCode)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneByName($categoryName);
        $subcategory = $this->getDoctrine()->getRepository(Category::class)->findOneBy(array('category' => $category, 'name' => $subcategoryName));        
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(array('code' => $productCode));        
        if($product->getCategories()->contains($subcategory)) {
            return $this->render('product/index.html.twig', [
                'product' => $product,
                'subcategory' => $subcategory,
                'category' => $category
            ]);
        } else {
            throw new NotFoundHttpException("Product not found");
        }   
    }
    
    /**
     * @Route("/{categoryName}/{subcategoryName}", name="show_subcategory_product")
     */
    public function showSubcategoryProductsAction(string $categoryName, string $subcategoryName)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneByName($categoryName);
        $subcategory = $this->getDoctrine()->getRepository(Category::class)->findOneBy(array('category' => $category, 'name' => $subcategoryName));        
        $products = $this->getDoctrine()->getRepository(Product::class)->findByCategory($subcategory);
        if(null === $products) {
            throw new NotFoundHttpException("Products not found");
        } else {  
            return $this->render('subcategory/index.html.twig', [
                'products' => $products,
                'subcategory' => $subcategory,
                'category' => $category
            ]);
        }
    }
    
    /**
     * @Route("/{categoryName}", name="show_category_product")
     */
    public function showCategoryProductsAction(string $categoryName)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneByName($categoryName);
        $subcategories = $category->getSubcategories();
        $products = array();
        foreach($subcategories as $subcategory) {
            $products[] = $this->getDoctrine()->getRepository(Product::class)->findByCategory($subcategory);
        }        
        if(empty($products)) {
            throw new NotFoundHttpException("Products not found");
        } else {  
            return $this->render('category/index.html.twig', [
                'allProducts' => $products,
                'subcategories' => $subcategories,
                'category' => $category
            ]);
        }
    }
}
