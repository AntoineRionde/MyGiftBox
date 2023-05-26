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

/* squelette.twig */
class __TwigTemplate_928d33f49638936a50e2c27ec781bdaf extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<html>
<head>
    ";
        // line 3
        $this->loadTemplate("header.twig", "squelette.twig", 3)->display($context);
        // line 4
        echo "</head>

<body>
    ";
        // line 7
        $this->loadTemplate("navbar.twig", "squelette.twig", 7)->display($context);
        // line 8
        echo "
    ";
        // line 9
        $this->displayBlock('body', $context, $blocks);
        // line 12
        echo "
    ";
        // line 13
        $this->loadTemplate("footer.twig", "squelette.twig", 13)->display($context);
        // line 14
        echo "</body>
</html>";
    }

    // line 9
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 10
        echo "
    ";
    }

    public function getTemplateName()
    {
        return "squelette.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 10,  66 => 9,  61 => 14,  59 => 13,  56 => 12,  54 => 9,  51 => 8,  49 => 7,  44 => 4,  42 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "squelette.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\squelette.twig");
    }
}
