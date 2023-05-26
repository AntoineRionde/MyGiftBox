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
class __TwigTemplate_dead0c4e02170762a29c6f5cf0700628 extends Template
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
    <title>Prestation ";
        // line 3
        echo twig_escape_filter($this->env, ($context["presta_id"] ?? null), "html", null, true);
        echo "</title>
</head>
<body>
<h1>Prestation ";
        // line 6
        echo twig_escape_filter($this->env, ($context["presta_id"] ?? null), "html", null, true);
        echo "</h1>
<h2>libelle : ";
        // line 7
        echo twig_escape_filter($this->env, (($__internal_compile_0 = ($context["presta"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["libelle"] ?? null) : null), "html", null, true);
        echo "</h2>
<h2>description : ";
        // line 8
        echo twig_escape_filter($this->env, (($__internal_compile_1 = ($context["presta"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["description"] ?? null) : null), "html", null, true);
        echo "</h2>
</body>
</html>";
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
        return array (  55 => 8,  51 => 7,  47 => 6,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "prestationView.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\prestationView.twig");
    }
}
