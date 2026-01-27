<?php

namespace App\Controller\Api;

use App\Entity\Cocktail;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShowCocktailController extends AbstractController
{

	#[Route(path: '/api/cocktails/{id}', name: 'api.cocktails.show', methods: ['GET'])]
	public function __invoke(#[MapEntity(message: 'Cocktail not found')] Cocktail $cocktail): Response
	{
		$data = $this->json($cocktail, 200, [], [
			'groups' => ['cocktail:read']
		]);

		return JsonResponse::fromJsonString($data);
	}
}