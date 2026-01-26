<?php

namespace App\Controller\Api;

use App\Dto\ListCocktailsQuery;
use App\Repository\CocktailRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ListCocktailsController
{

	public function __construct(
		private readonly CocktailRepository $cocktailRepository,
		private readonly SerializerInterface $serializer
	)	{
	}

	#[Route(path: '/api/cocktails', name: 'api.cocktails.list', methods: ['GET'])]
	// design pattern invokable controller (unique action)
	public function __invoke(#[MapQueryString] ListCocktailsQuery $query): Response
	{
		$cocktails = $this->cocktailRepository->findAllWithQuery($query);

		$data = $this->serializer->serialize($cocktails, 'json', [
			//'groups' => ['cocktail:read'] // define groups in Cocktail Entity as attribute #[Groups(['cocktail:read'])]
		]);

		// if the data to send is already encoded in JSON
		return JsonResponse::fromJsonString($data);
	}
}