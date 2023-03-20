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

/* layout.twig */
class __TwigTemplate_1368aa83e2c4e6b040a0a059f73c9c710c5105d8dbd9378bcaf00660176f4be3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'styles' => [$this, 'block_styles'],
            'content' => [$this, 'block_content'],
            'scripts' => [$this, 'block_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo " | Starter</title>

    <link rel=\"shortcut icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/public/includes/img/slim.svg\">

    <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/public/includes/libs/bootstrap/bootstrap.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/public/includes/css/styles.css\">
    ";
        // line 13
        $this->displayBlock('styles', $context, $blocks);
        // line 14
        echo "</head>
<body>
    ";
        // line 16
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "    
    <script src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->getBasePath(), "html", null, true);
        echo "/public/includes/libs/bootstrap/bootstrap.bundle.js\"></script>
    ";
        // line 19
        $this->displayBlock('scripts', $context, $blocks);
        // line 20
        echo "</body>
</html>";
    }

    // line 7
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 13
    public function block_styles($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 16
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 19
    public function block_scripts($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 19,  101 => 16,  95 => 13,  89 => 7,  84 => 20,  82 => 19,  78 => 18,  75 => 17,  73 => 16,  69 => 14,  67 => 13,  63 => 12,  59 => 11,  54 => 9,  49 => 7,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{% block title %}{% endblock %} | Starter</title>

    <link rel=\"shortcut icon\" href=\"{{ base_path() }}/public/includes/img/slim.svg\">

    <link rel=\"stylesheet\" href=\"{{ base_path() }}/public/includes/libs/bootstrap/bootstrap.css\">
    <link rel=\"stylesheet\" href=\"{{ base_path() }}/public/includes/css/styles.css\">
    {% block styles %}{% endblock %}
</head>
<body>
    {% block content %}{% endblock %}
    
    <script src=\"{{ base_path() }}/public/includes/libs/bootstrap/bootstrap.bundle.js\"></script>
    {% block scripts %}{% endblock %}
</body>
</html>", "layout.twig", "C:\\xampp-7\\htdocs\\slim4-twig-pdo-starter\\app\\Views\\layout.twig");
    }
}
