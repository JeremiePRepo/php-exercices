<?php

/*\
 | Ceci est la classe Article,
 | elle sert à représenter des articles
\*/

include_once 'Article.classe.php';

class ArticlePrive extends Article
{

    public function getTitrePrive($userEstConnecte) : string
    {
        if(isset($userEstConnecte) AND ($userEstConnecte === true))
        {
            return '<p>Article privé : </p>' . parent::getTitre();
        }
        else
        {
            return '<p>Ce titre est privé</p>';
        }
    }

    public function getContenuPrive($userEstConnecte) : string
    {
        if(isset($userEstConnecte) AND ($userEstConnecte === true))
        {
            return '<p>Article privé : </p>' . parent::getContenu();
        }
        else
        {
            return '<p>Ce contenu est privé</p>';
        }
    }

    public function afficheArticle()
    {
        if(isset($userEstConnecte))
        {
            echo '<p>Article privé : </p>';
            parent::afficheArticle();
        }
        else
        {
            echo '<p>Ce contenu est privé</p>';
        }
    }
}
