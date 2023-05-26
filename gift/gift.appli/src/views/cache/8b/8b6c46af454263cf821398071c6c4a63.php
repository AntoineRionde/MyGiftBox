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

/* categorieView.twig */
class __TwigTemplate_ab51082958b1d80b0c1c5df6ffe2f92e extends Template
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
        echo "<!DOCTYPE html>
<html>
<head>
    <title>Categorie ";
        // line 4
        echo twig_escape_filter($this->env, ($context["cat_id"] ?? null), "html", null, true);
        echo "</title>
</head>
<body>
<h1>Categorie ";
        // line 7
        echo twig_escape_filter($this->env, ($context["cat_id"] ?? null), "html", null, true);
        echo "</h1>
<h2>";
        // line 8
        echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["cat"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["libelle"] ?? null) : null), "html", null, true);
        echo "</h2>
<h2>";
        // line 9
        echo twig_escape_filter($this->env, (($__internal_compile_1 = ($context["cat"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["description"] ?? null) : null), "html", null, true);
        echo "</h2>

<h2>Prestations de cette catégorie</h2>

";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["prestaLies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["presta"]) {
            // line 14
            echo "<ul>
    <li><a href=\"/BUT-S4/Archi_logicielle/gift/gift.appli/public/index.php/prestation/";
            // line 15
            echo twig_escape_filter($this->env, (($__internal_compile_2 = $context["presta"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["id"] ?? null) : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (($__internal_compile_3 = $context["presta"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["libelle"] ?? null) : null), "html", null, true);
            echo "</a></li>
</ul>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['presta'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "categorieView.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 18,  70 => 15,  67 => 14,  63 => 13,  56 => 9,  52 => 8,  48 => 7,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "categorieView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\categorieView.twig");
    }
}
