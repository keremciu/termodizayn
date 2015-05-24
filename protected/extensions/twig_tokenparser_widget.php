<?php
/*
 * This file is an extension of Twig.
 *
 * (c) 2015 keremciu
 */
/**
 * parser widget tag in Yii framework
 *
 * {% beginwidget 'CActiveForm' as form %}
 *    content of form
 * {% endwidget %}
 *
 */
class Twig_TokenParser_Widget extends Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $name = $stream->expect(Twig_Token::STRING_TYPE);
        if($stream->test(Twig_Token::PUNCTUATION_TYPE)){
            $args = $this->parser->getExpressionParser()->parseHashExpression();
        }
        else{
            $args = new Twig_Node_Expression_Array(array(), $lineno);
        }

        $stream->expect(Twig_Token::NAME_TYPE);
        $assign = $stream->expect(Twig_Token::NAME_TYPE);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(array($this, 'decideBlockEnd'), true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new Yii_Node_WidgetBlock(array(
            'alias' => $name->getValue(),
            'assign' => $assign,
        ), $body, $args, $lineno, $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @param string The tag name
     */
    public function getTag()
    {
        return 'beginwidget';
    }

    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endwidget');
    }
}

class Yii_Node_WidgetBlock extends Twig_Node
{
    public function __construct($attrs, Twig_NodeInterface $body, Twig_Node_Expression_Array $args = NULL, $lineno, $tag)
    {
        $attrs = array_merge(array('value' => false),$attrs);
        $nodes = array('args' => $args, 'body' => $body); 
        parent::__construct($nodes, $attrs, $lineno,$tag);
    }

    public function compile(Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        $compiler->write('$context["'.$this->getAttribute('assign')->getValue().'"] = $context["this"]->beginWidget("'.$this->getAttribute('alias').'",');
        $argNode = $this->getNode('args');
        $compiler->subcompile($argNode)
                 ->raw(');')
                 ->raw("\n");

        $compiler->indent()->subcompile($this->getNode('body'));

        $compiler->raw('$context["this"]->endWidget();');
    }
}
?>