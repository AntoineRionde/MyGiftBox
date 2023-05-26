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

/* catCreateView.twig */
class __TwigTemplate_d6c1a481616d2d5e2ab5cdb5dd254f5d extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "squelette.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("squelette.twig", "catCreateView.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "<h2>Créer une catégorie : </h2>
<form method=\"post\" action=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categorieCreatePost"), "html", null, true);
        echo "\">
<label for=\"cat_libelle_input\">libelle</label>
<input type=\"text\" id=\"cat_libelle_input\" name=\"libelle\">
<label for=\"cat_desc_input\">description</label>
<input type=\"text\" id=\"cat_desc_input\" name=\"description\">
<input type=\"hidden\" name=\"csrf\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["csrf"] ?? null), "html", null, true);
        echo "\">
<button type=\"submit\">OK</button>
</form>
";
    }

    public function getTemplateName()
    {
        return "catCreateView.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 9,  53 => 4,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "catCreateView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\catCreateView.twig");
    }
}
