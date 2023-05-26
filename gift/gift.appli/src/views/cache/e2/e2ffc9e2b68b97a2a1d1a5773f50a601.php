<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* footer.twig */
class __TwigTemplate_fc09064def713a42f6ab1b0d5786041e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html>
<head>

</head>

<body>


";
        // line 9
        $this->displayBlock('footer', $context, $blocks);
        // line 12
        echo "</body>
</html>";
    }

    // line 9
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 10
        echo "    <footer>© 2023 My GiftBox app. Tous droits réservés.</footer>
";
    }

    public function getTemplateName()
    {
        return "footer.twig";
    }

    public function getDebugInfo()
    {
        return array (  59 => 10,  55 => 9,  50 => 12,  48 => 9,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "footer.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\footer.twig");
    }
}
