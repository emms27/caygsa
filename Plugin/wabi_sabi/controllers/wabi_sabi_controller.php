<?php
  /*Copyright (C) 2011 Jovany Leandro G.C <info@manadalibre.org>
   If you are asking what license this software is released under,
   you are asking the wrong question.
  */
  /*
   This program use code from http://felix.plesoianu.ro/php/wabisabi/ who
   owner is  Felix Pleșoianu <felixp7@yahoo.com>
  */

define('WABISABI_URL', '[a-z\\+]+://[\\w\\.-]+(:\\d+)?/[\\w$-.+!*\'(),\\?#%&;=~:\\/]*');
// Must not contain dots or slashes, it's a security risk!
define('WABISABI_WIKIWORD', '(([A-Z]+[a-z1-9_-]+){2,})');
define('WABISABI_HOMEPAGE', 'start');



/**
 *Integración Wabisabi y Cakephp 1.3.x
 */
class WabiSabiController extends WabisabiAppController
{
  var $name ='WabiSabi';
  var $uses = array('WabiSabi.WabiSabi');
  var $components = array('Session');

  var $preserved_strings = array();

  function index($page_name = "")
  {
    if(empty($page_name) || $page_name == WABISABI_HOMEPAGE)
      {
	$page_name = WABISABI_HOMEPAGE;
	$this->Session->write('wabisabi_breadcrumb',array());
      }
    
    $this->set('page_name', $page_name);
    $this->set('breadcrumb', $this->breadcrumb($page_name));
    $this->set('wiki', $this->wiki_render($this->page_retrieve($page_name), $this->wiki_patterns()));
  }

  function breadcrumb($page_name)
  {
    $d = $this->Session->read('wabisabi_breadcrumb');

    if(end($d) == $page_name)
      return $d;

    $d[] = $page_name;

    $this->Session->write('wabisabi_breadcrumb', $d);
    return $d;
  }

  function edit($page_name = "")
  {
    if(empty($page_name))
      $page_name = $this->data['WabiSabi']['page_name'];

    if(empty($this->data))
      {
	$this->data = $this->WabiSabi->find('first',array('conditions'=>array('WabiSabi.page_name'=>$page_name)));
	$this->data['WabiSabi']['page_name'] = $page_name;
      }
    else
      {

	if($this->WabiSabi->save($this->data))
	  {
	    $this->Session->setFlash(__('Saved correctrly',true));
	    $this->redirect(array('action'=>'index', $this->data['WabiSabi']['page_name']));
	  }
      }
  }

  private function wiki_render($text, $patterns = array()) {
    $tmp = $text;
    $tmp = preg_replace(
			array_keys($patterns),
			array_values($patterns),
			htmlspecialchars($tmp, ENT_QUOTES, "UTF-8"));
    return $this->tpl_render($tmp, $this->preserved_strings);
  }

  private function wiki_render_table($text) {
    $wiki_table_patterns = array(
				 '/^\s*\\|-/m' => '</tr><tr>',
				 '/^\s*\\|\\+(.*)/m' => '<th>$1</th>',
				 '/^\s*\\|(.*)/m' => '<td>$1</td>');

    return preg_replace(
			array_keys($wiki_table_patterns),
			array_values($wiki_table_patterns),
			$text);
  }


  private function wiki_patterns()
  {
    $patterns = array(
		      '/^\\{\\{\\{(.*?)\\}\\}\\}/mse' => '$this->wiki_preserve(\'<pre>$1</pre>\');',
		       '/\s*==+\s*$/m' => '',
		       '/^======(.*)/m' => '<h6 class="wabisabi">$1</h6>',
		       '/^=====(.*)/m' => '<h5 class="wabisabi">$1</h5>',
		       '/^====(.*)/m' => '<h4 class="wabisabi">$1</h4>',
		       '/^===(.*)/m' => '<h3 class="wabiabi">$1</h3>',
		       '/^==(.*)/m' => '<h2 class="wabisabi">$1</h2>',
		       '/^\s*$/m' => '<p class="wabisabi">',
		       '/^----+/m' => "<hr class=\"wabisabi\">\n",
		       '/^:(.*)/m' => '<blockquote class="wabisabi">$1</blockquote>',
		       '/^\\*+(.*)/m' => '<ul class="wabisabi"><li class="wabisabi">$1</li></ul>',
		       '/^#+(.*)/m' => '<ol class="wabisabi"><li class="wabisabi">$1</li></ol>',
		       '/^;([^:]+):(.*)/m' => '<dl class="wabisabi"><dt class="wabisabi">$1</dt><dd>$2</dd></dl>',
		       '!(</ul>\s<ul>)|(</ol>\s<ol>)|(</dl>\s<dl>)!m' => "\n",
		       '/^\\{\\|(.*?)\\|\\}/mse'
		       => '"<table ><tr>".$this->wiki_render_table("$1")."</tr></table>";',

		       '|\\{\\{(' . WABISABI_URL . ')(.*?)\\}\\}|e'
		       => '$this->wiki_preserve(\'<img src="$1" alt="$3">\');',
		       '|\\[(' . WABISABI_URL . ')(.+?)\\]|e'
		       => '$this->wiki_preserve(\'<a href="$1">$3</a>\');',
		       '|(' . WABISABI_URL . ')|e' => '$this->wiki_preserve(\'<a href="$1">$1</a>\');',
		       '/' . WABISABI_WIKIWORD . '/' => '<a class="wabisabi" href="$1">$1</a>',

		       '/\\{\\{\\{(.*?)\\}\\}\\}/e' => '$this->wiki_preserve(\'<code>$1</code>\');',
		       '/\\*\\*(.*?)\\*\\*/' => '<b class="wabisabi">$1</b>',
		       '|//(.*?)//|' => '<i class="wabisabi">$1</i>',
		       '/\\\\\\\\/' => "<br>\n",
		       '/\\^\\^(.*?)\\^\\^/' => '<sup class="wabisabi">$1</sup>',
		       '/,,(.*?),,/' => '<sub class="wabisabi">$1</sub>');


    return $patterns;
  }


  private function wiki_preserve($text) {
     $gensym = '_' . count($this->preserved_strings);
     $this->preserved_strings[$gensym] = $text;

     return "\$$gensym";
  }


  private function tpl_render($text, $tpl_vars) {
    return preg_replace('/\\$(\\w+)/e',
			'isset($tpl_vars["$1"]) ? $tpl_vars["$1"] : "";', $text);
  }

  private function page_retrieve($page_name) {

    $page_text = $this->WabiSabi->field('content',array('page_name'=>$page_name));

    if (empty($page_text)) {
      return __("Page $page_name does not exist yet.",true);
    } else {
      return $page_text;
    }
  }

}

?>
