<?php

namespace App\Dto;

// final: empêche les classes enfants de redéfinir une méthode, une propriété ou constante
// readonly: all properties of that class will be readonly (initialized once and no changes possible)
final readonly class ListCocktailsQuery
{
	public function __construct(
		public ?string $name = null,
		public ?bool $isAlcoholic = null,
		public ?int $difficulty = null,
		public int $page = 1,
		public int $itemsPerPage = 10,
	)	{
		
	}
} 