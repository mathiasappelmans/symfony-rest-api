<?php

namespace App\Controller\Api;

use App\Dto\ListCocktailsQuery;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListCocktailsController extends AbstractController
{

	public function __construct(
		private readonly CocktailRepository $cocktailRepository,
		private readonly SerializerInterface $serializer
	)	{
	}

	#[Route(path: '/api/cocktails', name: 'api.cocktails.list', methods: ['GET'])]
	/* design pattern invokable controller (unique action)
	Invokable controllers are used in Laravel to handle a single, 
	specific action per controller class, 
	adhering to the Single Responsibility Principle and improving code maintainability. 
	By using the __invoke method, routing becomes cleaner and more intuitive, 
	as the URL maps directly to the controller class rather than a specific method.  */
	public function __invoke(#[MapQueryString] ListCocktailsQuery $query): Response
	{		
		$cocktails = $this->cocktailRepository->findAllWithQuery($query);
		
		/* $data = $this->serializer->serialize($cocktails, 'json', [
			'groups' => ['cocktail:read'] // define groups in Cocktail Entity as attribute #[Groups(['cocktail:read'])]
		]); */ 
		
		// with extends AbstractController
		$data = $this->json($cocktails, 200, [], [
			'groups' => ['cocktail:read']
		]);

		return JsonResponse::fromJsonString($data);
	}
}