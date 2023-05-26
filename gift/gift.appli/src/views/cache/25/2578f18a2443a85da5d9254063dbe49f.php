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

/* prestationView.twig */
class __TwigTemplate_bba59fd1e848c54675b7d226e92e7ae9 extends Template
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
        $this->parent = $this->loadTemplate("squelette.twig", "prestationView.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "<html>
<head>
    <title>Prestation ";
        // line 5
        echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["presta"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        echo "</title>

</head>
<body>
<h1>Prestation ";
        // line 9
        echo twig_escape_filter($this->env, (($__internal_compile_1 = ($context["presta"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
        echo "</h1>
<h2>libelle : ";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_compile_2 = ($context["presta"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["libelle"] ?? null) : null), "html", null, true);
        echo "</h2>
<img src=\"../../../../shared/img/";
        // line 11
        echo twig_escape_filter($this->env, (($__internal_compile_3 = ($context["presta"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["img"] ?? null) : null), "html", null, true);
        echo "\" alt=\"image de la prestation\" width=\"350\" height=\"350\"  />
<h2>description : ";
        // line 12
        echo twig_escape_filter($this->env, (($__internal_compile_4 = ($context["presta"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["description"] ?? null) : null), "html", null, true);
        echo "</h2>


</body>
</html>

";
    }

    public function getTemplateName()
    {
        return "prestationView.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 12,  69 => 11,  65 => 10,  61 => 9,  54 => 5,  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "prestationView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\prestationView.twig");
    }
}
