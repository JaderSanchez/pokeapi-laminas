<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Http\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Http\Request;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);
        $offset = $page * 20 - 20;

        $nameFilter = $this->params()->fromRoute('nameFilter', '');
        $offsetAndLimit = empty($nameFilter) ? "?offset=$offset&limit=20" : "?offset=0&limit=1302";

        $request = new Client();
        $request->setMethod(Request::METHOD_GET);
        $request->setUri("https://pokeapi.co/api/v2/pokemon$offsetAndLimit");
        $response = $request->send();

        if (!$response->isSuccess())
            return new ViewModel( [ 'errorMessage' => 'Ocurrió un error al cargar los datos' ] );
            
        $pokemonList = json_decode($response->getBody(), true)['results'];

        $pokemons = [];

        foreach ($pokemonList as $pokemon) {

            if (str_contains($pokemon['name'], $nameFilter))
            {
                $request = new Client();
                $request->setMethod(Request::METHOD_GET);
                $request->setUri($pokemon['url']);
                $response = $request->send();

                if (!$response->isSuccess())
                    return new ViewModel( [ 'errorMessage' => 'Ocurrió un error al cargar los datos' ] );

                $pokemons[] = json_decode($response->getBody(), true);
            }
        }

        // Create pagination
        $maxPages = 66;

        $pagesStart = $page - 2;
        while ($pagesStart < 1) $pagesStart++;
        while ($pagesStart >= ($maxPages - 3)) $pagesStart--;

        $pagesArray = [];
        for ($i = 0; $i < 5; $i++) 
            $pagesArray[] = $pagesStart + $i;

        $pages = [];
        $pages[] = [ 'label' => '&laquo;', 'page' => ($page > 1 ? $page - 1 : $page), 'enabled' => ($page > 1), 'selected' => false ];

        foreach ($pagesArray as $currentPage)
            $pages[] = [ 'label' => $currentPage, 'page' => $currentPage, 'enabled' => true, 'selected' => ($currentPage == $page) ];

        $pages[] = [ 'label' => '&raquo;', 'page' => ($page + 1), 'enabled' => ($page < $maxPages), 'selected' => false ];

        return new ViewModel( [ 'pokemons' => $pokemons, 'nameFilter' => $nameFilter, 'pages' => $pages ] );
    }

    public function viewAction()
    {   
        $id = $this->params()->fromRoute('id');

        $request = new Client();
        $request->setMethod(Request::METHOD_GET);
        $request->setUri("https://pokeapi.co/api/v2/pokemon/$id");
        $response = $request->send();

        if (!$response->isSuccess())
            return new ViewModel( [ 'errorMessage' => 'Ocurrió un error al cargar los datos' ] );

        $pokemon = json_decode($response->getBody(), true);

        return new ViewModel( [ 'pokemon' => $pokemon ] );
    }
}
