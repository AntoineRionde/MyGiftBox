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

/* categoriesView.twig */
class __TwigTemplate_362d7b13186e49b0018553f1f912d174 extends Template
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
        echo "<html>
<head>
    <title>Categories</title>
</head>
<body>
<ul>
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["categorie"]) {
            // line 8
            echo "
    <li><a href=\"/BUT-S4/Archi_logicielle/gift/gift.appli/public/index.php/categorie/";
            // line 9
            echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["categorie"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (($__internal_compile_1 = $context["categorie"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["libelle"] ?? null) : null), "html", null, true);
            echo "</a></li>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['categorie'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "
</ul>
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "categoriesView.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 12,  52 => 9,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "categoriesView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\categoriesView.twig");
    }
}
