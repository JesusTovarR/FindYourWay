<?php

/* lieux.html.twig */
class __TwigTemplate_2ce42244ecbfc3e593e2b38e984e5c7a7f43ca34728f682a551c36462468cf85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<head> <title>Oh le beau Template</title> </head>
<body>
<h2> koukou</h2><br />
";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tabLieux"]) ? $context["tabLieux"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["lieu"]) {
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($context["lieu"], "id", array()), "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lieu'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "lieux.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "lieux.html.twig", "/var/www/FindYourWay/api/private/backoffice/templates/lieux.html.twig");
    }
}
