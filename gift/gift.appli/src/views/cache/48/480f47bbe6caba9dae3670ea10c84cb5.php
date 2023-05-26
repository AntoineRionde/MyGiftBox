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

/* header.twig */
class __TwigTemplate_b821c762d92c28f273ea7da9b5140e24 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'header' => [$this, 'block_header'],
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
        $this->displayBlock('header', $context, $blocks);
        // line 6
        echo "</head>

<body>

</body>
</html>";
    }

    // line 3
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "        <h1>My GiftBox app</h1>
    ";
    }

    public function getTemplateName()
    {
        return "header.twig";
    }

    public function getDebugInfo()
    {
        return array (  57 => 4,  53 => 3,  44 => 6,  42 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.twig", "C:\\xampp\\htdocs\\BUT-S4\\Archi_logicielle\\gift\\gift.appli\\src\\views\\header.twig");
    }
}
