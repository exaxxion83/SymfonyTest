<?php

namespace JC\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\src\JC\PlatformBundle\Entity\Article;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use JC\PlatformBundle\Entity\Advert;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
	public function indexAction($page)
	{
		if($page < 1)
		{
			throw new NotFoundHttpException('Page"'.$page.'"inexistante.');
		}

		return $this->render('JCPlatformBundle:Advert:index.html.twig', [ 'page' => $page]);
	}

	public function viewAction($id)
	{

		$repository = $this->getDoctrine()->getManager()->getRepository('JCPlatformBundle:Advert');

		$advert = $repository->find($id);

		if(null === $advert)
		{
			throw new NotFoundHttpException("L'annonce n'existe pas ");
		}

		return $this->render('JCPlatformBundle:Advert:view.html.twig', array(
			'advert' => $advert->getId($id) 
			));
		/*return $this->render('JCPlatformBundle:Advert:view.html.twig', array(
			'id' => $id
			));
		$tag = $request->query->get('tag');

		return new Response($tag);*/

		//return new Response("Affichage de l'annonce d'id : ".$id);
		//$url = $this->get('router')->generate('jc_platform_view', array('id' =>5));
		//$content = $this->get('templating')->render('JCPlatformBundle:Advert:index.html.twig', array('id' => 6));
		//return new Response($content);
		//return new Response("l'url de l'annonce d'id 5 est : ".$url);
		
	}

	public function addAction(Request $request)
	{

		/*$antispam = $this->container->get('jc_platform.antispam');

		$text = 'f';

		if($antispam->isSpam($text))
		{
			throw new \Exception('votre message est un spam');
		}

		return new Response('le message n\' est pas un spam');*/
		$advert = new Advert();
		$advert->setTitle('Recherche developpeur symfony');
		$advert->setAuthor('alexandre');
		$advert->setContent("nousfdfjdfd dfjdsfkldsffj  jdfjdsfl dsfjdslf j dfsdfjjdslfj sdfkl df sd df dsf");

		$em = $this->getDoctrine()->getManager();

		$em->persist($advert);

		$em->flush();

		if($request->isMethod('POST'))
		{
			$request->getSession()->getFlashBag()->add('notice','Annonce bien enregistree');

			return $this->render('JCPlatformBundle:Advert:add.html.twig');
		}

		return $this->render('JCPlatformBundle:Advert:add.html.twig', array('advert' => $advert->getId()));
	}

	public function deleteAction($id)
	{
		return $this->render('JCPlatformBundle:Advert:delete.html.twig');
	}
	/*$article = new Article();
		$article->setArticle("article 1");
		$reponse = $article->getArticle();
		
		$form = $this->createFormBuilder($article)
			->add('title', TextType::class)
			->add('save',SubmitType::class)
			->getForm();

		$content = $this->get('templating')->render('JCPlatformBundle:Advert:index.html.twig', array('nom'=>'jean'));
		return new Response($content);

		return $this->render('JCPlatformBundle:Default:index.html.twig', array('form' => $form->createView()));*/
	/*public function indexAction()
	{
		$id = '';
		$url= $this->generateUrl('hello_the_world');
		return new Response($url);
		//return $this->redirect('http://www.google.com');
		//return new Response("notre propre hello world !");
	}*/
}