<?php
function displayHead(){
    echo "<!DOCTYPE html>" . PHP_EOL;
    echo "<html lang=\"fr\">" . PHP_EOL;
    echo "<head>" . PHP_EOL;
    echo "    <title>La Cabane Anti-Gaspi</title>" . PHP_EOL;
    echo "    <meta charset=\"utf-8\">" . PHP_EOL;
    echo "    <meta name=\"author\" content=\"Jérémie Pasquis\">" . PHP_EOL;
    echo "    <meta name=\"description\" content=\"Toutes les astuces pour éviter le gaspillage\">" . PHP_EOL;
    echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">" . PHP_EOL;
    echo "    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.5.0/css/all.css\" integrity=\"sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU\" crossorigin=\"anonymous\">" . PHP_EOL;
    echo "    <link href=\"https://fonts.googleapis.com/css?family=Oswald:300\" rel=\"stylesheet\">" . PHP_EOL;
    echo "    <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700\" rel=\"stylesheet\">" . PHP_EOL;
    echo "    <link href=\"https://fonts.googleapis.com/css?family=Merriweather:400i\" rel=\"stylesheet\">" . PHP_EOL;
    echo "    <link rel=\"stylesheet\" href=\"vue/css/style.min.css\">" . PHP_EOL;
    echo "</head>" . PHP_EOL;
    echo "<body>" . PHP_EOL;
    echo "    <div class=\"container\">" . PHP_EOL;
    echo "            <header>" . PHP_EOL;
    echo "                <a href=\"/\" class=\"header-logo\"><img src=\"vue/img/logos/logo.jpg\" alt=\"Logo La Cabane Anti-gaspi\"></a>'" . PHP_EOL;
}

function displayNav(){
    echo "<nav class=\"header-nav\">" . PHP_EOL ;
    echo "    <button type=\"button\" class=\"header-nav-btn\"><i class=\"fas fa-bars\"></i> Menu</button>" . PHP_EOL ;
    echo "    <ul class=\"header-nav-content is-close\">" . PHP_EOL ;
    echo "        <li><a href=\"#\">À propos</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Fait maison</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Zéro déchet</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Locavorisme</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Enfant des bois</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Permaculture</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Éco voyage</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">\"Les épluchures\", le livre !</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">\"Notre aventure sans frigo\", le livre !</a></li>" . PHP_EOL ;
    echo "        <li><a href=\"#\">Parutions presse</a></li>" . PHP_EOL ;
    echo "    </ul>" . PHP_EOL ;
    echo "</nav>" . PHP_EOL ;
}

function displayContent(){
    echo "</header>" . PHP_EOL;
    echo "<div class=\"main-content\">" . PHP_EOL;
    echo "    <div class=\"articles\">" . PHP_EOL;
    echo "        <article class=\"article\">" . PHP_EOL;
    echo "            <figure><img src=\"vue/img/articles/article1.jpg\" alt=\"\"></figure>" . PHP_EOL;
    echo "            <div class=\"article-texts\">" . PHP_EOL;
    echo "                <h2 class=\"article-title\">Lire entre les vignes</h2>" . PHP_EOL;
    echo "                <div class=\"article-informations\">" . PHP_EOL;
    echo "                    <time datetime=\"2018-03-16\">16 mars 2018</time>" . PHP_EOL;
    echo "                    <a href=\"#\" class=\"article-informations-comments\">Laisser un commentaire</a>" . PHP_EOL;
    echo "                </div>" . PHP_EOL;
    echo "                <p>Le sauternes de La Clotte-Cazalis, à Barsac, est sincère, frais, vivant à l’image de celle qui le façonne amoureusement. Chez Marie-Pierre, pas de mécanique, pas de maquillage, pas d’artifice. On travaille à l’ancienne, en fonction des constellations, des cycles lunaires, avec le soutien des plantes et de Taropa, le cheval de trait.</p>" . PHP_EOL;
    echo "                <a href=\"#\">Lire la suite &rarr;</a>" . PHP_EOL;
    echo "            </div>" . PHP_EOL;
    echo "        </article>" . PHP_EOL;
    echo "        <article class=\"article\">" . PHP_EOL;
    echo "            <figure><img src=\"vue/img/articles/article2.jpg\" alt=\"\"></figure>" . PHP_EOL;
    echo "            <div class=\"article-texts\">" . PHP_EOL;
    echo "                <h2 class=\"article-title\">Petite cuisine pour avoir bonne mine &hellip;</h2>" . PHP_EOL;
    echo "                <div class=\"article-informations\">" . PHP_EOL;
    echo "                    <time datetime=\"2018-02-13\">13 février 2018</time>" . PHP_EOL;
    echo "                    <a href=\"#\" class=\"article-informations-comments\">4 commentaires</a>" . PHP_EOL;
    echo "                </div>" . PHP_EOL;
    echo "                <p>Il fait gris dehors et votre teint commence à prendre les couleurs du ciel ? Voici des petites recettes pour retrouver une peau de pêche en deux coups de cuillères à pot, et devinez quoi ? Les ingrédients pour réaliser la crème de la crème se trouvent juste là, dans vos placards de cuisine.</p>" . PHP_EOL;
    echo "                <a href=\"#\">Lire la suite &rarr;</a>" . PHP_EOL;
    echo "            </div>" . PHP_EOL;
    echo "        </article>" . PHP_EOL;
    echo "        <article class=\"article\">" . PHP_EOL;
    echo "            <figure><img src=\"vue/img/articles/article3.jpg\" alt=\"\"></figure>" . PHP_EOL;
    echo "            <div class=\"article-texts\">" . PHP_EOL;
    echo "                <h2 class=\"article-title\">Ciel ! J'ai mes lunes &hellip;</h2>" . PHP_EOL;
    echo "                <div class=\"article-informations\">" . PHP_EOL;
    echo "                    <time datetime=\"2018-02-05\">5 février 2018</time>" . PHP_EOL;
    echo "                    <a href=\"#\" class=\"article-informations-comments\">9 commentaires</a>" . PHP_EOL;
    echo "                </div>" . PHP_EOL;
    echo "                <p>Une fois n’est pas coutume, j’évoquerais au fil de ce nouveau billet nos lunes, nos coquelicots, nos isabelles, nos fleurs, nos bénéfices, nos ourses, nos culottes françaises… Si le sujet est resté longtemps tabou, forcé de constater que les fabuleux écrits de Miranda Gray (dont le fameux Lune rouge), suivi de près du mouvement « zéro déchet » ont fait évolué les mentalités… Accueillez donc avec honneur et légèreté votre féminin sacré.</p>" . PHP_EOL;
    echo "                <a href=\"#\">Lire la suite &rarr;</a>" . PHP_EOL;
    echo "            </div>" . PHP_EOL;
    echo "        </article>" . PHP_EOL;
    echo "        <a href=\"#\" class=\"btn\">Articles précédents</a>" . PHP_EOL;
    echo "    </div>" . PHP_EOL;
}

function displaySide(){
    echo "<aside>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Nos 2 livres</h3>" . PHP_EOL;
    echo "            <a href=\"#\"><figure><img src=\"vue/img/aside/books.png\" alt=\"Livres\"></figure></a>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section class=\"youtube\">" . PHP_EOL;
    echo "            <h3>BA de notre \"Aventure sans frigo\"</h3>" . PHP_EOL;
    echo "            <!-- Start Youtube video integration -->" . PHP_EOL;
    echo "            <iframe src=\"https://videopress.com/embed/R47x8qzQ\" allowfullscreen></iframe>" . PHP_EOL;
    echo "            <script src=\"https://videopress.com/videopress-iframe.js\"></script>" . PHP_EOL;
    echo "            <!-- End Youtube video integration -->" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Slow journalism</h3>" . PHP_EOL;
    echo "            <a href=\"#\"><figure><img src=\"vue/img/aside/slow_journalism.jpg\" alt=\"Saladier remplis de légumes\"></figure></a>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Retrouvez la cabane anti-gaspi sur les réseaux sociaux</h3>" . PHP_EOL;
    echo "            <div class=\"social-links\">" . PHP_EOL;
    echo "                <a href=\"#\"><i class=\"fab fa-facebook-square\"></i></a>" . PHP_EOL;
    echo "                <a href=\"#\"><i class=\"fab fa-instagram\"></i></a>" . PHP_EOL;
    echo "                <a href=\"#\"><i class=\"fab fa-youtube-square\"></i></a>" . PHP_EOL;
    echo "            </div>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Pour me contacter</h3>" . PHP_EOL;
    echo "            <address><a href=\"mailto:mariecochard@mpluso.com\">mariecochard@mpluso.com</a></address>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section class=\"blogger-network\">" . PHP_EOL;
    echo "            <figure><h3><img src=\"vue/img/aside/zero_waste_logo.png\" alt=\"Logo Zero Waste Bloggers Network\"></h3></figure>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section class=\"copyright\">" . PHP_EOL;
    echo "            <h3>COPYRIGHT &copy; 2016 LACABANE-ANTIGASPI. DESIGNED BY MPLUSO</h3>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "    </aside>" . PHP_EOL;
    echo "</div>" . PHP_EOL;
    echo "</div>" . PHP_EOL;
}

function displayFooter(){
    echo "<footer>" . PHP_EOL;
    echo "        <section class=\"news\">" . PHP_EOL;
    echo "            <h3>News</h3>" . PHP_EOL;
    echo "            <nav>" . PHP_EOL;
    echo "                <ul class=\"news-list-container\">" . PHP_EOL;
    echo "                    <li>" . PHP_EOL;
    echo "                        <a href=\"#\">LIRE ENTRE LES VIGNES</a>" . PHP_EOL;
    echo "                        <time datetime=\"2018-03-16\">16 mars 2018</time>" . PHP_EOL;
    echo "                    </li>" . PHP_EOL;
    echo "                    <li>" . PHP_EOL;
    echo "                        <a href=\"#\">PETITE CUISINE POUR AVOIR BONNE MINE …</a>" . PHP_EOL;
    echo "                        <time datetime=\"2018-02-13\">13 février 2018</time>" . PHP_EOL;
    echo "                    </li>" . PHP_EOL;
    echo "                    <li>" . PHP_EOL;
    echo "                        <a href=\"#\">CIEL ! J’AI MES LUNES …</a>" . PHP_EOL;
    echo "                        <time datetime=\"2018-02-05\">5 février 2018</time>" . PHP_EOL;
    echo "                    </li>" . PHP_EOL;
    echo "                    <li>" . PHP_EOL;
    echo "                        <a href=\"#\">RECETTES « BIOTÉ » À CONCOCTER EN CUISINE !</a>" . PHP_EOL;
    echo "                        <time datetime=\"2018-01-29\">29 janvier 2018</time>" . PHP_EOL;
    echo "                    </li>" . PHP_EOL;
    echo "                    <li>" . PHP_EOL;
    echo "                        <a href=\"#\">EMBALLAGES « ZÉRO-DÉCHET »</a>" . PHP_EOL;
    echo "                        <time datetime=\"2018-01-02\">2 janvier 2018</time>" . PHP_EOL;
    echo "                    </li>" . PHP_EOL;
    echo "                </ul>" . PHP_EOL;
    echo "            </nav>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Catégories</h3>" . PHP_EOL;
    echo "            <nav>" . PHP_EOL;
    echo "                <ul class=\"categories-list-container\">" . PHP_EOL;
    echo "                    <li><a href=\"#\">ÉCO VOYAGE</a></li>" . PHP_EOL;
    echo "                    <li><a href=\"#\">ENFANTS DES BOIS</a></li>" . PHP_EOL;
    echo "                    <li><a href=\"#\">FAIT MAISON</a></li>" . PHP_EOL;
    echo "                    <li><a href=\"#\">LOCAVORISME</a></li>" . PHP_EOL;
    echo "                    <li><a href=\"#\">PERMACULTURE</a></li>" . PHP_EOL;
    echo "                    <li><a href=\"#\">ZÉRO DÉCHETS</a></li>" . PHP_EOL;
    echo "                </ul>" . PHP_EOL;
    echo "            </nav>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "        <section>" . PHP_EOL;
    echo "            <h3>Mentions légales</h3>" . PHP_EOL;
    echo "            <p>Toute reproduction ou représentation totale ou partielle de ce site (textes et images) par quelque procédé que ce soit, sans l’autorisation expresse du propriétaire du site ou de ses représentants légaux est interdite et constituerait une contrefaçon sanctionnée par les articles L335-2 et suivants du Code de la propriété intellectuelle.</p>" . PHP_EOL;
    echo "        </section>" . PHP_EOL;
    echo "    </footer>" . PHP_EOL;
    echo "    <script" . PHP_EOL;
    echo "  src=\"https://code.jquery.com/jquery-3.3.1.slim.js\" integrity=\"sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=\" crossorigin=\"anonymous\"></script>" . PHP_EOL;
    echo "    <script src=\"vue/js/script.js\"></script>" . PHP_EOL;
    echo "</body>" . PHP_EOL;
    echo "</html>" . PHP_EOL;
}

function callDisplay($section){
    call_user_func('display' . $section);
}

callDisplay("Head");
callDisplay("Nav");
callDisplay("Content");
callDisplay("Side");
callDisplay("Footer");