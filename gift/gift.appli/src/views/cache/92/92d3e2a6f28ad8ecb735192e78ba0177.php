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
class __TwigTemplate_0b8259c0130cb01f36383f208566c326 extends Template
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
        $this->parent = $this->loadTemplate("squelette.twig", "categorieView.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "<!DOCTYPE html>
<html>
<head>
    <title>Categorie ";
        // line 6
        echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["cat"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        echo "</title>
</head>
<body>
<h1>Categorie ";
        // line 9
        echo twig_escape_filter($this->env, (($__internal_compile_1 = ($context["cat"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
        echo "</h1>
<h2>";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_compile_2 = ($context["cat"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["libelle"] ?? null) : null), "html", null, true);
        echo "</h2>
<h2>";
        // line 11
        echo twig_escape_filter($this->env, (($__internal_compile_3 = ($context["cat"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["description"] ?? null) : null), "html", null, true);
        echo "</h2>

<h2>Prestations de cette catégorie : </h2>

";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["prestaLies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["presta"]) {
            // line 16
            echo "<ul>
    <li><a href=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("prestationId", ["id" => (($__internal_compile_4 = $context["presta"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["id"] ?? null) : null)]), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (($__internal_compile_5 = $context["presta"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["libelle"] ?? null) : null), "html", null, true);
            echo "</a></li>
</ul>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['presta'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "
</body>
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
        return array (  94 => 20,  83 => 17,  80 => 16,  76 => 15,  69 => 11,  65 => 10,  61 => 9,  55 => 6,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "categorieView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\categorieView.twig");
    }
}
