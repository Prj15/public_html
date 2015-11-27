 <?php

require_once 'Categorie.class.php' ;

class Webpage {
    /**
     * Texte compris entre <head> et </head>
     * @var string
     */
    private $head  = null ;
    /**
     * Texte compris entre <title> et </title>
     * @var string
     */
    private $title = null ;
    /**
     * Texte compris entre <body> et </body>
     * @var string
     */
    private $body  = null ;

    private $header = null ;

    private $articles = null ;

    private $footer = null ;

    /**
     * Constructeur
     * @param string $title Titre de la page
     */
    public function __construct($title=null) {
        $this->setTitle($title) ;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     */
    public function escapeString($string) {
        return htmlentities($string, ENT_QUOTES|ENT_HTML5, "utf-8") ;
    }

    /**
     * Affecter le titre de la page
     * @param string $title Le titre
     */
    public function setTitle($title) {
        $this->title = $title ;
    }

    /**
     * Ajouter un contenu dans head
     * @param string $content Le contenu à ajouter
     *
     * @return void
     */
    public function appendToHead($content) {
        $this->head .= $content ;
    }

    /**
     * Fonction qui permet d'ajouter un panel de catégories à la page
     * @param string $niveau le niveau d'autorisation a prendre en compte en affichant les catégories
     *
     */
    public function appendPanel($niveau) {
        $categories = Categorie::getAll($niveau);   
        
        $panel = <<<HTML
        <nav>
            <ul id = "categories">
HTML;

        foreach ($categories as $categorie) {
            $panel .= $categorie->toHtml($niveau);
        }

        $panel .= <<<HTML
            </ul>

            
            
        </nav>
HTML;

        $this->appendToHeader($panel);
    }

    /**
     * Ajouter un contenu CSS dans head
     * @param string $css Le contenu CSS à ajouter
     *
     * @return void
     */
    public function appendCss($css) {
        $this->appendToHead("<style type=''text/css''>".$css."</style>");
    }

    /**
     * Ajouter l'URL d'un script CSS dans head
     * @param string $url L'URL du script CSS
     *
     * @return void
     */
    public function appendCssUrl($url) {
        $this->appendToHead(<<<HTML
    <link rel="stylesheet" type="text/css" href="{$url}">
HTML
) ;
    }

    /**
     * Ajouter un contenu JavaScript dans head
     * @param string $js Le contenu JavaScript à ajouter
     *
     * @return void
     */
    public function appendJs($js) {
        $this->appendToHead(<<<HTML
    <script type='text/javascript'>
    $js
    </script>
HTML
) ;    
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans head
     * @param string $url L'URL du script JavaScript
     *
     * @return void
     */
    public function appendJsUrl($url) {
        $this->appendToHead(<<<HTML
    <script type='text/javascript' src='$url'></script>
HTML
) ;    
    }

    /**
     * Ajouter un contenu dans body
     * @param string $content Le contenu à ajouter
     * 
     * @return void
     */
    public function appendContent($content) {
        $this->body .= $content ;
    }

    /**
     * Ajouter du contenu au header
     *
     */
    public function appendToHeader($header) {
        $this->header .= $header ; 
    }

    /**
     * Ajout d'un article
     *
     */
    public function ajoutArticle($article) {
        $this->articles .= $article ;
    }

    /**
     * Ajouts au footer
     */
    public function appendToFooter($footer) {
        $this->footer .= $footer ; 
    }

    /**
     * Produire la page Web complète
     * @throws Exception si title n'est pas défini
     *
     * @return string
     */
    public function toHTML() {
        if (is_null($this->title)) {
            throw new Exception(__CLASS__ . ": title not set") ;
        }

        $lastmod = strftime("Dernière modification de cette page le %d/%m/%Y à %Hh%M", getlastmod()) ;
        return <<<HTML
<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{$this->title}</title>
        {$this->head}
    </head>

    <body>
        <header>
            {$this->header}
        </header>

        <section>
            {$this->articles}
        </section>

        {$this->body}

        <footer>
            {$this->footer}
            <span id='lastmodified'>{$lastmod}</span>
        </footer>
    </body>

</html>
HTML;
    }
}
