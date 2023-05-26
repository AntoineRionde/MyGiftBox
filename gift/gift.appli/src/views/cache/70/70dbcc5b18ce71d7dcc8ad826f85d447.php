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

/* navbar.twig */
class __TwigTemplate_c6daba10e37a33ad0ace5b4fe11c6a4e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
<nav>
    <ul>
";
        // line 7
        echo "
        <li> <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categories"), "html", null, true);
        echo "\"> Categories </a> </li>
        <li> <a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestations"), "html", null, true);
        echo "\"> Prestations </a> </li>

    </ul>

    <br />
    <br />
</nav>";
    }

    public function getTemplateName()
    {
        return "navbar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 9,  45 => 8,  42 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "navbar.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\navbar.twig");
    }
}
