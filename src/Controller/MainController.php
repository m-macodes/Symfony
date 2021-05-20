<?php

namespace App\Controller;

use App\Entity\Checkout;
use App\Entity\Items;
use App\Entity\ShopingCart;
use App\Form\CheckoutType;
use App\Repository\ItemsRepository;
use App\Repository\ShopingCartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private SessionInterface $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'title' => 'Магазин',
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/list', name: 'ShopList')]
    public function ShopList(ItemsRepository $itemsRepository): Response
    {
        $items = $itemsRepository->findAll();

        return $this->render('main/ShopList.html.twig', [
            'title' => 'Список товаров',
            'items' => $items,
        ]);
    }

    #[Route('/item/{id}', name: 'ShopItem')]
    public function Item(Items $item): Response
    {
        return $this->render('main/ShopItem.html.twig', [
            'title' => 'ShopItem',
            'item' => $item->getTitle(),
            'price' => $item->getPrice(),
            'description' => $item->getDescription(),
            'id' => $item->getId(),
        ]);
    }

    #[Route('/cart', name: 'shopCart')]
    public function ShopCart(ShopingCartRepository $repository): Response
    {
        $sessionId = $this->session->getId();

        $items = $repository->findBy(['sessionId' => $sessionId]);

        return $this->render('main/ShopCart.html.twig', [
            'title' => 'Корзина',
            'controller_name' => 'shop cart',
            'items' => $items,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'shopCartAdd')]
    public function ShopCartAdd(Items $item, EntityManagerInterface $em, ShopingCartRepository $repository): Response
    {
        $sessionId = $this->session->getId();

        if (!($shopCart = $repository->findOneBy(['product' => $item->getId(), 'sessionId' => $sessionId])))
            $shopCart = new ShopingCart();

        $shopCart
            ->setSessionId($sessionId)
            ->setProduct($item)
            ->setCount(($shopCart->getCount()) + 1);

        $em->persist($shopCart);
        $em->flush();

        return $this->redirectToRoute('ShopItem', ['id' => $item->getId()]);
    }

    #[Route('/order', name: 'shopOrder')]
    public function ShopOrder(Request $request, EntityManagerInterface $em): Response
    {
        $order = new Checkout();

        $form = $this->createForm(CheckoutType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $order
                ->setSessionId($this->session->getId())
                ->setStatus('new');
            $em->persist($order);
            $em->flush();
            $this->session->migrate();

            return $this->redirectToRoute('index');
        }


        return $this->render('main/ShopOrder.html.twig', array(
            'title'=> 'Оформление заказа',
            'form' => $form->createView(),
        ));
    }
}
